@extends('layouts.layout')

@section('title', 'Homework System — Домашнее задание')

@section('header__content')
    @include('layouts.header_student_teacher')
@endsection

@section('main__content')
    <div class="main__content">
        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="login__modal mt6rem mb4rem">
            <div class="login__header">{{ isset($homework) ? "Изменить" : "Создать" }} домашнее задание</div>
            @if ($errors->any())
                <div class="alert alert-danger mt1rem">
                    <ul class="no-margin">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form class="login__form" method="post"
                  action="{{ isset($homework) ? route('homework.update', $homework['id']) : route('homework.store') }}">
                @csrf
                @isset($homework)
                    @method('PUT')
                @endisset
                <label class="label-input">
                    Название
                    <input type="text" name="hw_title"
                           class="login__form-input mt7px @error('hw_title') error @enderror"
                           value="{{ old('hw_title') ?? $homework['title']  ?? '' }}">
                </label>
                <label class="label-input">
                    Максимальное число попыток
                    <input type="number" name="hw_max_attempts"
                           class="login__form-input mt7px @error('hw_max_attempts') error @enderror"
                           value="{{ old('hw_max_attempts') ?? $homework['max_attempts']  ?? '' }}">
                </label>
                <label class="label-input">
                    Баллы
                    <input type="number" name="hw_total_marks"
                           class="login__form-input mt7px @error('hw_total_marks') error @enderror"
                           value="{{ old('hw_total_marks') ?? $homework['total_marks'] ?? '' }}">
                </label>
                <label class="label-input">
                    Проходные баллы
                    <input type="number" name="hw_passing_marks"
                           class="login__form-input mt7px @error('hw_passing_marks') error @enderror"
                           value="{{ old('hw_passing_marks') ?? $homework['passing_marks'] ?? '' }}">
                </label>
                <label class="label-input">
                    Дата начала
                    <input type="date" name="hw_start_date"
                           class="login__form-input mt7px @error('hw_start_date') error @enderror"
                           value="{{ old('hw_start_date') ?? $homework['start_date'] ?? date('Y-m-d') }}">
                </label>
                <label class="label-input">
                    Дата конца
                    <input type="date" name="hw_end_date"
                           class="login__form-input mt7px @error('hw_end_date') error @enderror"
                           value="{{ old('hw_end_date') ?? $homework['end_date'] ?? '' }}">
                </label>
                <label class="label-input">
                    Описание
                    <textarea name="hw_description"
                              class="login__form-input h200 mt7px @error('hw_description') error @enderror"
                              maxlength="150">{{ old('hw_description') ?? $homework['description'] ?? '' }}</textarea>
                </label>
                <input type="hidden" name="updated_by" value="{{ $id }}">
                <input type="hidden" name="course_id" value="{{ $course_id }}">
                @unless(isset($homework))
                    <input type="hidden" name="created_by" value="{{ $id }}">
                @endunless
                <button class="enter__link">
                    {{ isset($homework) ? "Сохранить" : "Создать" }}
                </button>
            </form>
        </div>
        @isset($homework)
            <div class="login__modal w40p mb4rem">
                <div class="login__header">Создать задачу</div>
                @if ($errors->hasBag('create_task_form'))
                    <div class="alert alert-danger mt1rem">
                        <ul class="no-margin">
                            @foreach ($errors->getBag('create_task_form')->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form class="login__form" method="post" action="{{route('task.store')}}">
                    @csrf
                    <input type="text" name="title" class="login__form-input @error('title','create_task_form') error @enderror"
                           placeholder="Название"
                           value="{{ session('empty_old_for_create_task_form') ?? old('title') ?? '' }}">
                    <div class="divwithtooltip">
                        <label class="label-input" for="type">Тип</label>
                        <div class="tooltip "> ⓘ
                            <div class="tooltip-text">
                                <ul>
                                    <li>Одиночный выбор<p>Требуется выбрать один верный вариант ответа</p></li>
                                    <li>Соответствие слову <p>Tребуется ввести слово и проверить его соответствие
                                            варианту ответа</p></li>
                                    <li>Множественный выбор<p>Требуется выбрать верную комбинацию ответов</p></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <select id="type" name="type" class="login__form-input mt7px">
                        <option
                            {{ session('empty_old_for_create_task_form') ?? old('type') === 'single_choice' ? 'selected' : '' }}
                            value="single_choice">Одиночный выбор
                        </option>
                        <option
                            {{ session('empty_old_for_create_task_form') ?? old('type') === 'word_match' ? 'selected' : '' }} value="word_match">
                            Соответствие слову
                        </option>
                        <option
                            {{ session('empty_old_for_create_task_form') ?? old('type') === 'multiple_choice' ? 'selected' : '' }}
                            value="multiple_choice">Множественный выбор
                        </option>
                    </select>
                    <textarea name="description" class="login__form-input h50 @error('description','create_task_form') error @enderror"
                              maxlength="150"
                              placeholder="Описание">{{ session('empty_old_for_create_task_form') ?? old('description') ?? '' }}</textarea>
                    <textarea name="options" class="login__form-input @error('title','create_task_form') error @enderror"
                              maxlength="150"
                              placeholder="Варианты ответа через пробел">{{ session('empty_old_for_create_task_form') ?? old('options') ?? '' }}</textarea>
                    <textarea name="answer" class="login__form-input @error('answer','create_task_form') error @enderror"
                              maxlength="150"
                              placeholder="Правильные варианты ответа через пробел">{{ session('empty_old_for_create_task_form') ?? old('answer') ?? '' }}</textarea>
                    <input type="number" name="score" class="login__form-input @error('score','create_task_form') error @enderror"
                           placeholder="Количество баллов"
                           value="{{ session('empty_old_for_create_task_form') ?? old('score') ?? '' }}">
                    <input type="hidden" name="created_by" value="{{ $id }}">
                    <input type="hidden" name="updated_by" value="{{ $id }}">
                    <input type="hidden" name="homework_id" value="{{ $homework['id'] }}">
                    <input type="hidden" name="course_id" value="{{ $course_id }}">
                    <button class="register__modal-link">Создать</button>
                </form>
            </div>

            @foreach ($homework->tasks as $index=>$task)
                <div class="login__modal w40p mb4rem">
                    <div class="login__header">Задача {{ $index+1 }} </div>
                    @if ($errors->hasBag('task_form_'. $task['id']))
                        <div class="alert alert-danger mt1rem">
                            <ul class="no-margin">
                                @foreach ($errors->getBag('task_form_'. $task['id'])->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="post" action="{{route('task.update', $task['id'])}}">
                        @csrf
                        @method('PUT')
                        <label class="label-input">
                            Название
                            <input type="text" name="title"
                                   class="login__form-input mt7px @error('title','task_form_'. $task['id']) error @enderror"
                                   value="{{ session('old_task_form_' . $task['id'])['title'] ?? $task['title'] }}">
                        </label>
                        <div class="divwithtooltip">
                            <label class="label-input mt7px" for="type">Тип</label>
                            <div class="tooltip "> ⓘ
                                <div class="tooltip-text">
                                    <ul>
                                        <li>Одиночный выбор<p>Требуется выбрать один верный вариант ответа</p></li>
                                        <li>Соответствие слову <p>Tребуется ввести слово и проверить его соответствие
                                                варианту ответа</p></li>
                                        <li>Множественный выбор<p>Требуется выбрать верную комбинацию ответов</p></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <select id="type" name="type" class="login__form-input mt7px">
                            <option
                                value="single_choice" {{ (session('old_task_form_' . $task['id'])['type'] ?? $task['type']) === 'single_choice' ? 'selected' : '' }}>
                                Одиночный выбор
                            </option>
                            <option
                                value="word_match" {{ (session('old_task_form_' . $task['id'])['type'] ?? $task['type']) === 'word_match' ? 'selected' : '' }}>
                                Соответствие слову
                            </option>
                            <option
                                value="multiple_choice" {{ (session('old_task_form_' . $task['id'])['type'] ?? $task['type']) === 'multiple_choice' ? 'selected' : '' }}>
                                Множественный выбор
                            </option>
                        </select>

                        <label class="label-input">
                            Правильный ответ
                            <textarea name="answer" class="login__form-input mt7px @error('answer','task_form_'. $task['id']) error @enderror" maxlength="150"
                            >{{ session('old_task_form_' . $task['id'])['answer']  ?? $task['answer'] }}</textarea>
                        </label>
                        <label class="label-input">
                            Варианты ответа
                            <textarea name="options" class="login__form-input mt7px @error('options','task_form_'. $task['id']) error @enderror" maxlength="150"
                            >{{ session('old_task_form_' . $task['id'])['options'] ?? $task['options'] }}</textarea>
                        </label>
                        <label class="label-input">
                            Описание
                            <textarea name="description" class="login__form-input h50 mt7px @error('description','task_form_'. $task['id']) error @enderror" maxlength="150"
                            >{{ session('old_task_form_' . $task['id'])['description'] ?? $task['description'] }}</textarea>
                        </label>
                        <label>
                            Количество баллов
                            <input type="number" name="score" class="login__form-input mt7px @error('score','task_form_'. $task['id']) error @enderror"
                                   value="{{ session('old_task_form_' . $task['id'])['score']  ?? $task['score'] }}">
                        </label>
                        <input type="hidden" name="homework_id" value="{{ $homework['id'] }}">
                        <input type="hidden" name="course_id" value="{{ $course_id }}">
                        <input type="hidden" name="updated_by" value="{{ $id }}">
                        <button class="enter__link mt1rem">Сохранить</button>
                    </form>
                    <form action="{{ route('task.destroy', $task['id']) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="homework_id" value="{{ $homework['id'] }}">
                        <input type="hidden" name="course_id" value="{{ $course_id }}">
                        <button class="enter__link bg-red mt1rem">Удалить</button>
                    </form>
                </div>
            @endforeach
        @endisset
    </div>
@endsection
