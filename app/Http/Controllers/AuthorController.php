<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AuthorController extends Controller
{
    public function singleAuthor($author)
    {
        if (isset($author) && $author != null) {
            $token = session()->get('token_key');
            $response = Http::withToken($token)
                ->withoutVerifying()
                ->accept('application/json')
                ->get(env('BASE_URL') . 'authors' . '/' . json_decode($author));

            $singleAuthor = json_decode($response->body());
            return view('singleAuthor', ['singleAuthor' => $singleAuthor]);
        } else {
            return redirect('dashboard');
        }
    }

    public function deleteAuthor($authorId)
    {
        if (isset($authorId) && $authorId != null) {
            $token = session()->get('token_key');
            $response = Http::withToken($token)
                ->withoutVerifying()
                ->accept('application/json')
                ->get(
                    env('BASE_URL') . 'authors' . '/' . json_decode($authorId)
                );
            $singleAuthor = json_decode($response->body())->books;

            if ($singleAuthor == null) {
                $response = Http::withToken($token)
                    ->withoutVerifying()
                    ->accept('application/json')
                    ->delete(
                        env('BASE_URL') .
                            'authors' .
                            '/' .
                            json_decode($authorId)
                    );

                session()->flash('message', 'Record deleted successfully');
                return response()->json([
                    'status' => 204,
                ]);
            } else {
                session()->flash(
                    'info',
                    'You will not be able to delete this Author'
                );
                return response()->json([
                    'status' => 200,
                ]);
            }
        } else {
            return response()->json([
                'status' => 404,
            ]);
        }
    }
}
