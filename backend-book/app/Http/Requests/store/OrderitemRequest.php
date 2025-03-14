<?php

namespace App\Http\Requests\store;

use Illuminate\Foundation\Http\FormRequest;

class OrderitemRequest extends FormRequest
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
        'id'=>"nullabel|id",
        'order_id'=>"required|uuid|exists:orders,id",
        'book_id'=>"required|uuid|exists:books,id",
        'quantity'=>"required|integer|min:1",
        'price'=>"required|numeric|min:0",
        ];
    }
}
