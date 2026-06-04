<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStandingEntryRequest extends FormRequest
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
            'category' => ['sometimes', 'string', 'max:100'],
            'season' => ['sometimes', 'string', 'max:20'],
            'position' => ['sometimes', 'integer', 'min:1'],
            'team_name' => ['sometimes', 'string', 'max:255'],
            'played' => ['nullable', 'integer'],
            'wins' => ['nullable', 'integer'],
            'draws' => ['nullable', 'integer'],
            'losses' => ['nullable', 'integer'],
            'goals_for' => ['nullable', 'integer'],
            'goals_against' => ['nullable', 'integer'],
            'points' => ['sometimes', 'integer'],
            'is_club' => ['boolean'],
        ];
    }
}
