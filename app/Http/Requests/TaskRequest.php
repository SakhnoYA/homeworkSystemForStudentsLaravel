<?php

namespace App\Http\Requests;

use App\Rules\Cyrillic;
use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    protected $errorBag = 'create_task_form';
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
            'title' => ['bail', 'required', 'alpha', 'min:5', 'max:30', new Cyrillic],
            'description' => ['bail', 'required', 'alpha', 'min:5', 'max:300', new Cyrillic],
            'score' => ['bail', 'integer', 'max:1000', 'min:1', 'nullable'],
            'options' => ['bail', 'required', 'regex:/^[А-я\s]+$/u', 'max:150'],
            'answer' => ['bail', 'required', 'regex:/^[А-я\s]+$/u', 'max:150']
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Название обязательно',
            'title.alpha' => 'Название должно содержать только буквы',
            'title.min' => 'Название должно содержать минимум 5 букв',
            'title.max' => 'Название должно содержать максимум 30 букв',
            'description.required' => 'Описание обязательно',
            'description.alpha' => 'Описание должно содержать только буквы',
            'description.min' => 'Описание должно содержать минимум 5 букв',
            'description.max' => 'Описание должно содержать максимум 300 букв',
            'score.integer' => 'Количество общих баллов должно быть числом',
            'score.max' => 'Количество общих баллов не может быть больше 1000',
            'score.min' => 'Количество общих баллов должно быть положительным числом',
            'options.required' => 'Варианты ответа обязательны',
            'options.regex' => 'Варианты ответа должны быть кириллическими словами, разделенные пробелом',
            'options.max' => 'Варианты ответа должны содержать 150 символов',
            'answer.required' => 'Правильные варианты ответа обязательны',
            'answer.regex' => 'Правильные варианты должны быть кириллическими словами, разделенные пробелом',
            'answer.max' => 'Правильные варианты должны содержать 150 символов'
        ];
    }

    /**
     * Handle a passed validation attempt.
     */
    protected function passedValidation(): void
    {
        $this['options'] = preg_replace('!\s+!', ' ', $this->options);
        $this['answer'] = preg_replace('!\s+!', ' ', $this->answer);
    }
}
