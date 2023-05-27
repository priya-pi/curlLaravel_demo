<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function getAuthors()
    {
        if (session()->has('token_key')) {
            $token = session()->get('token_key');
            $first_name = session()->get('first_name');
            $last_name = session()->get('last_name');

            $response = Http::withToken($token)
                ->withoutVerifying()
                ->accept('application/json')
                ->get(env('BASE_URL')."authors");
            $authors = json_decode($response->body())->items;

            return view('dashboard', [
                'authors' => $authors,
                'first_name' => $first_name,
                'last_name' => $last_name,
            ]);
        } else {
            return redirect('/');
        }
    }

}
