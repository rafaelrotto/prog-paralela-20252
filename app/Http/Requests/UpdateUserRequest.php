<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $authUser = auth()->user();

        $user = User::find($this->route('user'));

        if ($authUser->type != 'admin' && $this->input('type') == 'admin') {
            return false;
        }

        if ($authUser->type != 'admin' && $user && $user->company_id != $authUser->company_id) {
            return false;
        }

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
            'name' => 'sometimes|max:50|string',
            'email' => [
                'sometimes',
                Rule::unique('users', 'email')->ignore($userId),
                'max:100',
                'string'
            ],
            'status' => 'sometimes|in:active,inactive',
            'type' => 'sometimes|in:admin,manager,teacher,student',
            'password' => 'sometimes|min:8|max:50|string',
            'password_confirmation' => 'required_with:password|min:8|max:50|string|same:password',
        ];
    }

    public function messages() {
        return [
            'name.max' => 'O campo nome deve conter no máximo :max caracteres',
            'name.string' => 'O campo nome deve ser uma string',
            'email.unique' => 'O email informado já está em uso',
            'email.max' => 'O campo email deve conter no máximo :max caracteres',
            'email.string' => 'O campo email deve ser uma string',
            'status.in' => 'O campo status deve ser "active" ou "inactive"',
            'type.in' => 'O campo tipo deve ser "admin", "manager", "teacher" ou "student"',
            'password.min' => 'O campo senha deve conter no mínimo :min caracteres',
            'password.max' => 'O campo senha deve conter no máximo :max caracteres',
            'password.string' => 'O campo senha deve ser uma string',
            'password_confirmation.required_with' => 'O campo confirmação de senha é obrigatório quando o campo senha é informado',
            'password_confirmation.min' => 'O campo confirmação de senha deve conter no mínimo :min caracteres',
            'password_confirmation.max' => 'O campo confirmação de senha deve conter no máximo :max caracteres',
            'password_confirmation.string' => 'O campo confirmação de senha deve ser uma string',
            'password_confirmation.same' => 'O campo confirmação de senha deve ser igual ao campo senha'
        ];
    }
}
