<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePalmaresRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'club_id' => ['sometimes', 'integer', 'exists:clubs,id'],
            'competition' => ['sometimes', 'string', 'max:255'],
            'year' => ['sometimes', 'integer', 'min:1900', 'max:2100'],
            'rank' => ['sometimes', 'string', 'max:50'],
            'description' => ['nullable', 'string'],
        ];
    }
}
