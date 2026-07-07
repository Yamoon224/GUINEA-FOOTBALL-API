<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMatchTicketRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'club_match_id' => ['sometimes', 'integer', 'exists:club_matches,id'],
            'type' => ['sometimes', 'string', 'max:50'],
            'price' => ['sometimes', 'string', 'max:50'],
            'available' => ['sometimes', 'integer', 'min:0'],
            'total' => ['sometimes', 'integer', 'min:0'],
        ];
    }
}
