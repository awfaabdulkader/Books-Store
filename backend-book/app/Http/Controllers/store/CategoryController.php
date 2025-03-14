<?php

namespace App\Http\Controllers\store;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\store\Category;
use App\Http\Controllers\Controller;
use App\Models\translation\Booktranslation;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        // Validate request
        $request->validate([
            'name' => 'required|string|max:255',
            'translations' => 'nullable|array',
            'translations.*.language_code' => ['required', 'string', 'max:5'],
            'translations.*.name' => ['required', 'string', 'max:255'],
        ]);

        // Create category
        $category = Category::create([
            'id' => Str::uuid(), // Generate UUID
            'name' => $request->name, // Default language name
        ]);

        // Store translations if provided
        if ($request->has('translations')) {
            foreach ($request->translations as $translation) {
                BookTranslation::create([
                    'translatable_type' => Category::class,
                    'translatable_id' => $category->id,
                    'language_code' => $translation['language_code'],
                    'name' => $translation['name'],
                ]);
            }
        }

        return response()->json(['message' => 'Category created successfully!', 'category' => $category], 201);
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
