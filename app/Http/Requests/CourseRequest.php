<?php

namespace App\Http\Requests;

use App\Rules\Cyrillic;
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
            'title' => ['bail', 'required','alpha', 'min:5', 'max:30', new Cyrillic],
            'start_date' => ['bail', 'date', 'nullable'],
            'end_date' => ['bail', 'date', 'after_or_equal:start_date', 'nullable'],
            'description' => ['bail', 'alpha', 'min:5', 'max:300', 'nullable', new Cyrillic],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Название обязательно',
            'title.unique' => 'Данный курс присутствует в системе',
            'title.alpha' => 'Название должно содержать только буквы',
            'title.min' => 'Название должно содержать минимум 5 букв',
            'title.max' => 'Название должно содержать максимум 30 букв',
            'end_date.after_or_equal' => 'Дата окончания должна быть позднее даты начала',
            'description.alpha' => 'Описание должно содержать только буквы',
            'description.min' => 'Описание должно содержать минимум 5 букв',
            'description.max' => 'Описание должно содержать максимум 300 букв',
        ];
    }
}
