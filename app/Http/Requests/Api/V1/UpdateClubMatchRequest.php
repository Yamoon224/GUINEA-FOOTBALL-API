<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClubMatchRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'club_id' => ['sometimes', 'integer', 'exists:clubs,id'],
            'category' => ['sometimes', 'string', 'max:100'],
            'opponent' => ['sometimes', 'string', 'max:255'],
            'competition' => ['sometimes', 'string', 'max:255'],
            'match_date' => ['sometimes', 'date'],
            'match_time' => ['nullable', 'string', 'max:20'],
            'day_label' => ['nullable', 'string', 'max:20'],
            'venue' => ['sometimes', 'string', 'max:50'],
            'stadium' => ['nullable', 'string', 'max:255'],
            'is_home' => ['boolean'],
            'status' => ['sometimes', 'in:scheduled,completed'],
            'club_score' => ['nullable', 'integer', 'min:0', 'max:99'],
            'opponent_score' => ['nullable', 'integer', 'min:0', 'max:99'],
        ];
    }
}
