<?php

namespace App\Http\Requests;

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
            'title' => ['bail', 'required', 'min:5', 'max:30'],
            'description' => ['bail', 'required', 'min:5', 'max:300'],
            'score' => ['bail', 'integer', 'max:1000', 'min:1', 'nullable'],
            'options' => ['bail', 'required', 'max:150'],
            'answer' => ['bail', 'required', 'max:150'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Название обязательно',
            'title.min' => 'Название должно содержать минимум 5 букв',
            'title.max' => 'Название должно содержать максимум 30 букв',
            'description.required' => 'Описание обязательно',
            'description.min' => 'Описание должно содержать минимум 5 букв',
            'description.max' => 'Описание должно содержать максимум 300 букв',
            'score.integer' => 'Количество общих баллов должно быть числом',
            'score.max' => 'Количество общих баллов не может быть больше 1000',
            'score.min' => 'Количество общих баллов должно быть положительным числом',
            'options.required' => 'Варианты ответа обязательны',
            'options.max' => 'Варианты ответа должны содержать 150 символов',
            'answer.required' => 'Правильные варианты ответа обязательны',
            'answer.max' => 'Правильные варианты должны содержать 150 символов',
        ];
    }

    /**
     * Handle a passed validation attempt.
     */
    protected function passedValidation(): void
    {
        $pattern = '/("[^"]*"|\S+)/u';

        preg_match_all($pattern, $this->options, $matches1);
        $this['options'] = implode(
            ' ',
            array_map(fn ($word) => preg_replace('/"\s*(.*?)\s*"/', '"$1"', $word), $matches1[0])
        );
        preg_match_all($pattern, $this->answer, $matches2);
        $this['answer'] = implode(
            ' ',
            array_map(fn ($word) => preg_replace('/"\s*(.*?)\s*"/', '"$1"', $word), $matches2[0])
        );
    }
}
