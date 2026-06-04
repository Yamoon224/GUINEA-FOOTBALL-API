<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateNewsArticleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $article = $this->route('news');

        return [
            'club_id' => ['sometimes', 'integer', 'exists:clubs,id'],
            'slug' => ['sometimes', 'string', 'max:255', Rule::unique('news_articles', 'slug')->ignore($article?->id)],
            'title' => ['sometimes', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string'],
            'content' => ['sometimes', 'string'],
            'image' => ['nullable', 'string', 'max:255'],
            'category' => ['sometimes', 'string', 'max:100'],
            'published_at' => ['nullable', 'date'],
            'is_published' => ['boolean'],
        ];
    }
}
