<?php

namespace App\Http\Requests;

use App\Rules\Confirmed;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'login' => ['bail', 'required', 'integer', 'exists:users,id', 'max:2147483647', 'min:1', new Confirmed],
            'password' => ['bail', 'required', 'min:4', 'max:30']
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'login.required' => 'Поле ID обязательно',
            'login.integer' => 'ID должен быть числом',
            'login.exists' => 'Данный ID отсутствует в системе',
            'login.max' => 'ID не может быть больше 2147483647',
            'login.min' => 'ID должен быть положительным числом',
            'password.required' => 'Пароль обязателен',
            'password.min' => 'Пароль должен содержать минимум 4 символа',
            'password.max' => 'Пароль должно содержать максимум 30 символов',
        ];
    }
}
