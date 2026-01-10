<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VoziloStoreRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'user_id' => ['nullable', 'integer', 'exists:users,id'],
            'registracija' => ['nullable', 'string', 'max:20'],
            'marka_model' => ['required', 'string', 'max:120'],
            'godina' => ['nullable', 'integer'],
            'slika' => ['nullable', 'string'],
        ];
    }
}
