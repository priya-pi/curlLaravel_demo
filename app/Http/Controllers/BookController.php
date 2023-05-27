<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BookController extends Controller
{
    public function bookDelete($bookId)
    {
        if (isset($bookId) && $bookId != null) {
            $token = session()->get('token_key');
            $response = Http::withToken($token)
                ->withoutVerifying()
                ->accept('application/json')
                ->delete(
                    env('BASE_URL') . 'books' . '/' . json_decode($bookId)
                );

            session()->flash('message', 'Record deleted successfully');
            return response()->json([
                'status' => 204,
            ]);
        } else {
            return response()->json([
                'status' => 404,
            ]);
        }
    }

    public function addBook()
    {
        $token = session()->get('token_key');
        $response = Http::withToken($token)
            ->withoutVerifying()
            ->accept('application/json')
            ->get(env('BASE_URL') . 'authors');

        $authors = json_decode($response->body())->items;
        return view('add_book', ['authors' => $authors]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'author' => 'required',
            'title' => 'required',
            'release_date' => 'required',
            'description' => 'required|regex:/^[a-zA-Z ]*$/',
            'isbn' => 'required',
            'format' => 'required',
            'number_of_pages' => 'required',
        ]);

        $data = [
            'author' => ['id' => $request->author],
            'title' => $request->title,
            'release_date' => $request->release_date,
            'description' => $request->description,
            'isbn' => $request->isbn,
            'format' => $request->format,
            'number_of_pages' => (int) $request->number_of_pages,
        ];

        $token = session()->get('token_key');
        $response = Http::withToken($token)
            ->withoutVerifying()
            ->accept('application/json')
            ->post(env('BASE_URL') . 'books', $data);

        session()->flash('message', 'Book created successfully');
        return redirect('/dashboard');
    }
}
