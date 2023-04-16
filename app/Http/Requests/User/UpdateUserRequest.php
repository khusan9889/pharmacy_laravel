<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
        'role_id' => 'required|numeric',
        'username' => 'required|unique:users,username',
        'password' => 'required|min:6',
        'first_name' => 'required',
        'last_name' => 'required',
        'patronymic' => 'nullable',
        'phone_number' => 'required|unique:users,phone_number',
        'email' => 'required|email|unique:users,email',
        ];
    }
}
