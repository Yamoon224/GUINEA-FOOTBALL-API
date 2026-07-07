<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Validator;

class StorePlayerRequest extends FormRequest
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
        return [
            'team_id' => ['required', 'integer', 'exists:teams,id'],
            'number' => ['nullable', 'integer', 'min:1', 'max:99'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'date_of_birth' => ['nullable', 'date'],
            'position' => ['nullable', 'string', 'max:100'],
            'height' => ['nullable', 'string', 'max:20'],
            'photo' => ['nullable', function ($attribute, $value, $fail) {
                $rules = $value instanceof UploadedFile ? ['image', 'max:5120'] : ['string', 'url'];

                $validator = Validator::make([$attribute => $value], [$attribute => $rules]);

                if ($validator->fails()) {
                    $fail($validator->errors()->first($attribute));
                }
            }],
        ];
    }
}
