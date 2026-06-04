<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class StoreClubMatchRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'club_id' => ['required', 'integer', 'exists:clubs,id'],
            'category' => ['required', 'string', 'max:100'],
            'opponent' => ['required', 'string', 'max:255'],
            'competition' => ['required', 'string', 'max:255'],
            'match_date' => ['required', 'date'],
            'match_time' => ['nullable', 'string', 'max:20'],
            'day_label' => ['nullable', 'string', 'max:20'],
            'venue' => ['required', 'string', 'max:50'],
            'stadium' => ['nullable', 'string', 'max:255'],
            'is_home' => ['boolean'],
            'status' => ['required', 'in:scheduled,completed'],
            'club_score' => ['nullable', 'integer', 'min:0', 'max:99'],
            'opponent_score' => ['nullable', 'integer', 'min:0', 'max:99'],
        ];
    }
}
