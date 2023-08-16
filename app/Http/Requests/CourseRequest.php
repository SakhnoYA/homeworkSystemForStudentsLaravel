<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
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
            'title' => ['bail', 'required', 'min:5', 'max:30'],
            'start_date' => ['bail', 'date', 'nullable'],
            'end_date' => ['bail', 'date', 'after_or_equal:start_date', 'nullable'],
            'description' => ['bail', 'min:5', 'max:300', 'nullable'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Название обязательно',
            'title.min' => 'Название должно содержать минимум 5 букв',
            'title.max' => 'Название должно содержать максимум 30 букв',
            'end_date.after_or_equal' => 'Дата окончания должна быть позднее даты начала',
            'description.min' => 'Описание должно содержать минимум 5 букв',
            'description.max' => 'Описание должно содержать максимум 300 букв',
        ];
    }
}
