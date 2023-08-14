@extends('layouts.layout')

@section('title', 'Homework System — Курс')

@section('header__content')
    @include('layouts.header_student_teacher')
@endsection

@section('main__content')
    <div class="main__content padding-0-200">
        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="login__modal mt6rem">
            <div class="login__header">Курс</div>
            @if ($errors->any())
                <div class="alert alert-danger mt1rem">
                    <ul class="no-margin">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="post" action="{{ route('course.update', $course['id']) }}">
                @csrf
                @method('PUT')
                <label>
                    Название
                    <input type="text" name="title" class="login__form-input mt7px @error('title') error @enderror"
                           value="{{ old('title') ?? $course['title'] }}">
                </label>
                <label>
                    Дата начала
                    <input type="date" name="start_date"
                           class="login__form-input mt7px @error('start_date') error @enderror"
                           value="{{ old('start_date') ?? $course['start_date'] }}">
                </label>
                <label>
                    Дата конца
                    <input type="date" name="end_date"
                           class="login__form-input mt7px @error('end_date') error @enderror"
                           value="{{ old('end_date') ?? $course['end_date'] }}">
                </label>
                <label class="label-input mb16px">
                    <input type="checkbox" name="availability"
                        {{ (old('availability') ?? $course['availability']) ? 'checked' : '' }}/>
                    Доступен
                </label>
                <label class="label-input "> Категория <select name="category" class="login__form-input mt7px">
                        <option {{ $course['category'] === null ? 'selected' : '' }} ></option>
                        <option
                            {{ (old('category') ?? $course['category']) === 'Естественные науки' ? 'selected' : '' }}
                            value="Естественные науки">Естественные науки
                        </option>
                        <option {{ $course['category'] === 'Точные науки' ? 'selected' : '' }}
                                value="Точные науки">Точные науки
                        </option>
                        <option {{ $course['category'] === 'Технические науки' ? 'selected' : '' }}
                                value="Технические науки">Технические науки
                        </option>
                        <option
                            {{ $course['category'] === 'Социально-гуманитарные науки' ? 'selected' : '' }}
                            value="Социально-гуманитарные науки">Социально-гуманитарные науки
                        </option>
                    </select></label>
                <label class="label-input"> Сложность <select name="difficulty_level" class="login__form-input mt7px">
                        <option {{ $course['difficulty_level'] === null ? 'selected' : '' }}></option>
                        <option
                            {{ $course['difficulty_level'] === 'Легкий уровень' ? 'selected' : '' }}
                            value="Легкий уровень">Легкий уровень
                        </option>
                        <option
                            {{ $course['difficulty_level'] === 'Средний уровень' ? 'selected' : '' }}
                            value="Средний уровень">Средний уровень
                        </option>
                        <option
                            {{ $course['difficulty_level'] === 'Сложный уровень' ? 'selected' : '' }}
                            value="Сложный уровень">Сложный уровень
                        </option>
                    </select></label>
                <label class="label-input ">
                    Описание
                    <textarea name="description"
                              class="login__form-input h200 mt7px @error('description') error @enderror"
                              maxlength="50">{{ old('description') ??  $course['description'] }}</textarea>
                </label>
                <input type="hidden" name="updated_by" value="{{ $id }}">
                <button type="submit" class="enter__link mt1rem">Сохранить</button>
            </form>
        </div>
        <div class="register__modal mt1rem mb6rem">
            <form method="post" class="mb0">
                @csrf
                <button type="submit" name="toCreateHomework" class="register__modal-link">Создать домашнее задание
                </button>
            </form>
        </div>
        <div class="login__modal  mb6rem width-auto dark-slay-gray padding-20-20 ">
            @if ($course->homeworks->count()==0)
                Домашние задания отсутствуют
            @else
                <table class="tg">
                    <thead>
                    <tr>
                        <th class="tg-amwm">ID</th>
                        <th class="tg-amwm">Название</th>
                        <th class="tg-amwm">Описание</th>
                        <th class="tg-amwm">Всего попыток</th>
                        <th class="tg-amwm">Всего баллов</th>
                        <th class="tg-amwm">Проходные баллы</th>
                        <th class="tg-amwm">Дата начала</th>
                        <th class="tg-amwm">Дата конца</th>
                        <th class="tg-amwm">Время создания</th>
                        <th class="tg-amwm">Время обновления</th>
                        <th class="tg-amwm">Создал ID</th>
                        <th class="tg-amwm">Обновил ID</th>
                        <th class="tg-amwm"></th>
                        <th class="tg-amwm"></th>
                        <th class="tg-amwm"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($course->homeworks as $homework)
                        <tr>
                            <td class="{{ $rowClass }}">{{ $homework['id'] }}</td>
                            <td class="{{ $rowClass }}">{{ $homework['title'] }}</td>
                            <td class="{{ $rowClass }}">{{ $homework['description'] }}</td>
                            <td class="{{ $rowClass }}">{{ $homework['max_attempts'] }}</td>
                            <td class="{{ $rowClass }}">{{ $homework['total_marks'] }}</td>
                            <td class="{{ $rowClass }}">{{ $homework['passing_marks'] }}</td>
                            <td class="{{ $rowClass }}">{{ $homework['start_date'] }}</td>
                            <td class="{{ $rowClass }}">{{ $homework['end_date'] }}</td>
                            <td class="{{ $rowClass }}">{{ date('Y-m-d H:i', strtotime($homework['created_at'])) }}</td>
                            <td class="{{ $rowClass }}">{{ $homework['created_by'] }}</td>
                            <td class="{{ $rowClass }}">{{ $homework['updated_by'] }}</td>
                            <td class="{{ $rowClass }}">
                                <form method="post">
                                    @csrf
                                    <input type="hidden" name="homework_id" value="{{ $homework['id'] }}">
                                    <button class="table-button">Редактировать</button>
                                </form>
                            </td>
                            <td class="{{ $rowClass }}">
                                <form method="post">
                                    @csrf
                                    <input type="hidden" name="homework_id" value="{{ $homework['id'] }}">
                                    <button class="table-button">Результаты</button>
                                </form>
                            </td>
                            <td class="{{ $rowClass }}">
                                <form method="post">
                                    @csrf
                                    <input type="hidden" name="homework_id" value="{{ $homework['id'] }}">
                                    <button class="table-button">Удалить</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection
