<?php

namespace App\Http\Controllers\store;

use App\Models\store\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\store\BookRequest;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  
     public function index($lang)
     {
         $books = Book::with(['translations' => function ($query) use ($lang) {
             $query->where('language_code', $lang);
         }])->get();
 
         return response()->json($books);
     }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookRequest $request)
    {
        // Step 1: Create the book (base record)
        $book = Book::create($request->only(['category_id', 'price', 'stock']));

        // Step 2: Add translations
        foreach ($request->translations as $translation) {
            $book->translations()->create($translation);
        }

        return response()->json(['message' => 'Book created successfully!', 'book' => $book->load('translations')], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
