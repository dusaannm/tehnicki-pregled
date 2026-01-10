<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TerminUpdateRequest extends FormRequest
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
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'usluga_id' => ['required', 'integer', 'exists:uslugas,id'],
            'vozilo_id' => ['required', 'integer', 'exists:vozilos,id'],
            'datum' => ['required', 'date'],
            'vreme' => ['required'],
            'status' => ['required', 'in:pending,approved,completed,canceled,cancelled,rejected,done,na_cekanju,potvrdjen'],
            'registracija' => ['required', 'string', 'max:20'],
            'marka_model' => ['required', 'string', 'max:255'],
        ];
    }
}
