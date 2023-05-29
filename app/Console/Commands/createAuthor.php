<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Validation\Validator;

class createAuthor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:author {count}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'we can create author data';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $response = Http::withoutVerifying()
            ->accept('application/json')
            ->post('https://symfony-skeleton.q-tests.com/api/v2/token', [
                'email' => config('constants.EMAIL'),
                'password' => config('constants.PASSWORD'),
            ]);

        $jsonData = json_decode($response->body());
        $token = $jsonData->token_key;

        $count = $this->argument('count');

        for ($i = 0; $i < $count; $i++) {

            $first_name = $this->ask('Enter first name');
            $last_name = $this->ask('Enter last name');
            $birthday = $this->ask('Enter birthday');
            $biography = $this->ask('Enter biography');
            $gender = $this->anticipate('Enter your gender', ['female', 'male']);
            $place_of_birth = $this->ask('Enter place_of_birth');

            $validator = Validator::make(
                [
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'birthday' => $birthday,
                    'place_of_birth' => $place_of_birth,
                ],
                [
                    'first_name' => ['required'],
                    'last_name' => ['required'],
                    'birthday' => ['required'],
                    'place_of_birth' => ['required'],
                ]
            );

            if ($validator->fails()) {
                $this->info('Author not created. See error messages below:');

                foreach ($validator->errors()->all() as $error) {
                    $this->error($error);
                }

            } else {
                    $data = [
                        'first_name' => $first_name,
                        'last_name' => $last_name,
                        'birthday' => $birthday,
                        'biography' => $biography,
                        'gender' => $gender,
                        'place_of_birth' => $place_of_birth,
                    ];

                    $response = Http::withToken($token)
                        ->withoutVerifying()
                        ->accept('application/json')
                        ->post('https://symfony-skeleton.q-tests.com/api/v2/authors',$data);

                    if ($response->clientError()) {
                        $this->error('something went wrong...!');
                    } else {
                        $this->info('Author successfully created..!');
                    }
                    Log::info($response);
                }
        }
    }
}
