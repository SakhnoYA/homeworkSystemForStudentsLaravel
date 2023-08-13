<?php

namespace App\Http\Requests;

use App\Rules\Cyrillic;
use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
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
            'id' => ['bail', 'required', 'integer', 'unique:users,id', 'max:2147483647', 'min:1'],
            'first_name' => ['bail', 'required', 'alpha', 'min:2', 'max:30', new Cyrillic],
            'last_name' => ['bail', 'required', 'alpha', 'min:2', 'max:30', new Cyrillic],
            'middle_name' => ['bail', 'alpha', 'min:2', 'max:30', 'nullable', new Cyrillic],
            'password' => ['bail', 'required', 'min:4', 'max:30', 'confirmed'],
            'policy' => ['accepted'],
            'user_type_id'=> ['required']
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
            'policy.accepted' => 'Политика конфиденциальности должна быть принята',
            'id.required' => 'Поле ID обязательно',
            'id.integer' => 'ID должен быть числом',
            'id.unique' => 'Данный ID имеется в системе',
            'id.max' => 'ID не может быть больше 2147483647',
            'id.min' => 'ID должен быть положительным числом',
            'first_name.required' => 'Имя обязательно',
            'first_name.alpha' => 'Имя должно содержать только буквы',
            'first_name.min' => 'Имя должно содержать минимум 2 буквы',
            'first_name.max' => 'Имя должно содержать максимум 30 букв',
            'last_name.required' => 'Фамилия обязательна',
            'last_name.min' => 'Фамилия должна содержать минимум 2 буквы',
            'last_name.max' => 'Фамилия должна содержать максимум 30 букв',
            'last_name.alpha' => 'Фамилия должна содержать только буквы',
            'middle_name.alpha' => 'Отчество должно содержать только буквы',
            'middle_name.min' => 'Отчество должно содержать минимум 2 буквы',
            'middle_name.max' => 'Отчество должно содержать максимум 30 букв',
            'password.required' => 'Пароль обязателен',
            'password.min' => 'Пароль должен содержать минимум 4 символа',
            'password.max' => 'Пароль должно содержать максимум 30 символов',
            'password.confirmed' => 'Пароли не совпали',
            'user_type_id.required'=> 'Роль обязательна'
        ];
    }
}
