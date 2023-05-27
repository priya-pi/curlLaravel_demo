<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class registerController extends Controller
{
    public function index()
    {
        return view('loginAuth');
    }

    public function loginAuth(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'pass' => 'required',
        ]);

        $data['email'] = $request->email;
        $data['password'] = $request->pass;

        if (
            $data['email'] == config('constants.EMAIL') &&
            $data['password'] == config('constants.PASSWORD')
        ) {
            $response = Http::withoutVerifying()
                ->accept('application/json')
                ->post(env('BASE_URL')."token", $data);

            $jsonData = json_decode($response->body());
            session([
                'token_key' => $jsonData->token_key,
                'first_name' => $jsonData->user->first_name,
                'last_name' => $jsonData->user->last_name,
            ]);
            session()->flash('message', 'login successfully');
            return redirect('dashboard');
        } else {
            return back();
        }
    }

    public function logout(Request $request)
    {
        if ($request->session()->has('token_key')) {
            $request->session()->forget('token_key');
        }
        return redirect('/');
    }
}
