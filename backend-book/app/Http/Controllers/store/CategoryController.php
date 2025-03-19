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
    public function getCategoryTranslation($lang)
    {
        $categories = Category::whereHas('translations', function ($query) use ($lang) {
            $query->where('language_code', $lang);
        })->with(['translations' => function ($query) use ($lang) {
            $query->where('language_code', $lang);
        }])->get();
    
        return response()->json($categories);
    }


    public function index()
    {
        $fetchIndex= Category::with(['translations'=>function ($query)
        {
            $query->whereIn('language_code',['en' , 'fr' , 'ar']);
        }])->paginate(10);


        return response()->json(['message' => 'Fsuccessfully!', 'category' => $fetchIndex], 201);

    }
    
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

    public function update(Request $request, string $id)
    {
         // Validate request
         $request->validate([
            'name' => 'required|string|max:255',
            'translations' => 'nullable|array',
            'translations.*.language_code' => ['required', 'string', 'max:5'],
            'translations.*.name' => ['required', 'string', 'max:255'],
        ]);

        $updateCategory = Category::findOrFail($id);

        $updateCategory->update(['name'=>$request->name]);

        //update translation if provided
        // Update translations if provided
    if ($request->has('translations')) {
        foreach ($request->translations as $translation) {
            BookTranslation::updateOrCreate(
                [
                    'translatable_type' => Category::class,
                    'translatable_id' => $updateCategory->id,
                    'language_code' => $translation['language_code'],
                ],
                ['name' => $translation['name']]
            );
        }
    }

    return response()->json(['message' => 'Category updated successfully!', 'category' => $updateCategory], 200);
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

 
  
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $destroyCategory = Category::findOrFail($id);

        $destroyCategory->delete();

        return response()->json(['message'=>'destroy deleted successfully!','book' =>$destroyCategory],200);

    }
}
