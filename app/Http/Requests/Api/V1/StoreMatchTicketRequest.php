<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class StoreMatchTicketRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'club_match_id' => ['required', 'integer', 'exists:club_matches,id'],
            'type' => ['required', 'string', 'max:50'],
            'price' => ['required', 'string', 'max:50'],
            'available' => ['required', 'integer', 'min:0'],
            'total' => ['required', 'integer', 'min:0'],
        ];
    }
}
