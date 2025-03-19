<?php

namespace App\Http\Requests\translation;

use Illuminate\Foundation\Http\FormRequest;

class TranslationbookRequest extends FormRequest
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
            'translatable_id' => 'required|uuid',
            'translatable_type' => 'required|string|in:Book,Category',
            'language_code' => 'required|string|size:2', // e.g., 'en', 'fr', 'es'
            'name' => 'required|string|max:255',
            'desc' => 'nullable|string',
        ];
    }
}
