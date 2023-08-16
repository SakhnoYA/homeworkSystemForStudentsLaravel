<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HomeworkRequest extends FormRequest
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
            'hw_title' => ['bail', 'required', 'min:5', 'max:30'],
            'hw_max_attempts' => ['bail', 'integer', 'max:30', 'min:1', 'nullable'],
            'hw_total_marks' => ['bail', 'integer', 'max:1000', 'min:1', 'nullable'],
            'hw_passing_marks' => ['bail', 'integer', 'lte:hw_total_marks', 'min:0', 'nullable'],
            'hw_start_date' => ['bail', 'date', 'nullable'],
            'hw_end_date' => ['bail', 'date', 'after_or_equal:start_date', 'nullable'],
            'hw_description' => ['bail', 'min:5', 'max:300', 'nullable'],
        ];
    }

    public function messages(): array
    {
        return [
            'hw_title.required' => 'Название обязательно',
            'hw_title.min' => 'Название должно содержать минимум 5 букв',
            'hw_title.max' => 'Название должно содержать максимум 30 букв',
            'hw_max_attempts.integer' => 'Максимальное число попыток должно быть числом',
            'hw_max_attempts.max' => 'Максимальное число попыток не может быть больше 30',
            'hw_max_attempts.min' => 'Максимальное число попыток должно быть положительным числом',
            'hw_total_marks.integer' => 'Количество общих баллов должно быть числом',
            'hw_total_marks.max' => 'Количество общих баллов не может быть больше 1000',
            'hw_total_marks.min' => 'Количество общих баллов должно быть положительным числом',
            'hw_passing_marks.integer' => 'Количество проходных баллов должно быть числом',
            'hw_passing_marks.lte' => 'Количество проходных баллов не может быть больше количества общих баллов',
            'hw_passing_marks.min' => 'Количество проходных баллов должно быть положительным числом',
            'hw_end_date.after_or_equal' => 'Дата окончания должна быть позднее даты начала',
            'hw_description.min' => 'Описание должно содержать минимум 5 букв',
            'hw_description.max' => 'Описание должно содержать максимум 300 букв',
        ];
    }
}
