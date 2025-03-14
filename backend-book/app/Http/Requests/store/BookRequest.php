<?php

namespace App\Http\Requests\store;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id'=>'nullable|uuid',
           // 'category_id'=>'required|uuid|exists:categories,id',
            'price'=>"required|numeric|min :0",
            'stock'=>"required|integer|min :0",
            'Author'=>"required|string",
            //translation
            'translations' =>'required|array',
            'translations.*.language_code'=>'required|string|size:2',
            'translations.*name.'=>'required|string|max:255',
            'translations.*.desc'=>"nullable|string",
        ];
    }

    public function messages(): array
    {
        return [
            'category_id.required' => 'The category is required.',
            'category_id.uuid' => 'Invalid category format.',
            'category_id.exists' => 'Selected category does not exist.',
            'price.required' => 'Price is required.',
            'price.numeric' => 'Price must be a valid number.',
            'price.min' => 'Price cannot be negative.',
            'stock.required' => 'Stock quantity is required.',
            'stock.integer' => 'Stock must be a whole number.',
            'stock.min' => 'Stock cannot be negative.',
        ];
    }
}
