<?php

namespace App\Http\Requests\store;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
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
            
        "id" =>'nullable|uuid' ,
        'user_id'=>'required|uuid|exists:users,id' ,
        'book_id'=>'required|uuid|exists:books,id' ,
        'rating' =>'required|integer|min:1|max:5' ,
        'comment'=>'nullable|string' ,
        ];
    }
}
