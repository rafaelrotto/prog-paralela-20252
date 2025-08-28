<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
        $userId = $this->route('user');

        return [
            'name' => 'sometimes|max:1|string',
            'email' => [
                'sometimes',
                Rule::unique('users', 'email')->ignore($userId),
                'max:100',
                'string'
            ],
            'status' => 'sometimes|in:active,inactive',
            'password' => 'sometimes|min:8|max:50|string',
            'password_confirmation' => 'required_with:password|min:8|max:50|string|same:password',
        ];
    }

    public function messages() {
        return [
            'name.max' => 'O campo nome deve conter no máximo :max caracteres',
        ];
    }
}
