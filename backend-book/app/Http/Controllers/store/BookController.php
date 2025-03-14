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
     
         if ($books->isEmpty()) {
             return response()->json(['message' => 'No books found'], 404);
         }
     
         return response()->json($books);
     }


    /**
     * Store a newly created resource in storage.
     */
    public function store(BookRequest $request)
    {
        // Step 1: Create the book (base record)
        $book = Book::create($request->only(['category_id', 'price', 'stock','Author']));

        // Step 2: Add translations
        foreach ($request->translations as $translation) {
            $book->translations()->create($translation);
        }

        return response()->json(['message' => 'Book created successfully!', 'book' => $book->load('translations')], 201);
    }

    public function update(BookRequest $request, string $id)
    {
        $updateBook = Book::findOrFail($id);

        $updateBook->update($request->validated());

        //update translation

        foreach($request->translations as $translation)
        {
            $updateBook->translations()->updateOrCreate(
                ['language_code'=>$translation['language_code']],
                ['name' => $translation['name'], 'desc' => $translation['desc']]
            );
        }

        return response()->json(['message'=>'Book updated successfully!','book' =>$updateBook->load('translations')],200);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $destroyBook=Book::findOrFail($id);

        $destroyBook->delete();
        return response()->json(['message'=>'Book deleted successfully!','book' =>$destroyBook],200);

    }
}
