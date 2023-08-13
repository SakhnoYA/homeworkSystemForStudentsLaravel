<?php

namespace App\Http\Requests;

use App\Rules\Cyrillic;
use Illuminate\Foundation\Http\FormRequest;

class EditUserRequest extends FormRequest
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
            'first_name' => ['bail', 'required', 'alpha', 'min:2', 'max:30', new Cyrillic],
            'last_name' => ['bail', 'required', 'alpha', 'min:2', 'max:30', new Cyrillic],
            'middle_name' => ['bail', 'alpha', 'min:2', 'max:30', 'nullable', new Cyrillic],
        ];
    }

    public function messages(): array
    {
        return [
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
        ];
    }
}
