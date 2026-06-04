<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateClubRequest extends FormRequest
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
        $club = $this->route('club');

        return [
            'slug' => [
                'sometimes',
                'string',
                'max:100',
                'alpha_dash',
                Rule::unique('clubs', 'slug')->ignore($club?->id),
            ],
            'name' => ['sometimes', 'string', 'max:255'],
            'acronym' => ['nullable', 'string', 'max:20'],
            'founded_at' => ['nullable', 'date'],
            'city' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'logo' => ['nullable', 'url'],
            'hero' => ['nullable', 'url'],
            'primary_color' => ['nullable', 'string', 'max:20'],
            'secondary_color' => ['nullable', 'string', 'max:20'],
            'social' => ['nullable', 'array'],
            'social.facebook' => ['nullable', 'url'],
            'social.youtube' => ['nullable', 'url'],
            'social.instagram' => ['nullable', 'url'],
        ];
    }
}
