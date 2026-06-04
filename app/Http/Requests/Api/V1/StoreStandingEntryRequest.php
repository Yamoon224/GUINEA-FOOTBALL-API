<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class StoreStandingEntryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'club_id' => ['required', 'integer', 'exists:clubs,id'],
            'competition' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:100'],
            'season' => ['required', 'string', 'max:20'],
            'position' => ['required', 'integer', 'min:1'],
            'team_name' => ['required', 'string', 'max:255'],
            'played' => ['nullable', 'integer'],
            'wins' => ['nullable', 'integer'],
            'draws' => ['nullable', 'integer'],
            'losses' => ['nullable', 'integer'],
            'goals_for' => ['nullable', 'integer'],
            'goals_against' => ['nullable', 'integer'],
            'points' => ['required', 'integer'],
            'is_club' => ['boolean'],
        ];
    }
}
