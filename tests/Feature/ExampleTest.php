<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_that_true_is_true(): void
    {
        $this->assertTrue(true);
    }

    public function test_asserting_an_exact_json_match(): void
    {

        $data = [
            'email' => 'ahsoka.tano@q.agency',
            'password' => ' Kryze4President',
        ];

        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
        ])->json('POST', env('BASE_URL') . 'token', $data);

        $response->dumpHeaders();
        $response->dd($response);
        $response->assertStatus(200)->assertJson([
            'status' => "success",
            'msg' => 'Completed'
        ]);
        $this->withoutExceptionHandling();
    }
}
