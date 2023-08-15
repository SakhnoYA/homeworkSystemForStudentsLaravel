@extends('layouts.layout')

@section('title', 'Homework System — Изменить пользователя')

@section('script')
    @vite('resources/js/checklist.js')
@endsection

@section('header__content')
    @include('layouts.header_admin')
@endsection

@section('main__content')
    <div class="main__content">
        <div class="login__modal mt6rem mb6rem">
            <div class="login__header">Профиль</div>
            @if ($errors->any())
                <div class="alert alert-danger mt1rem">
                    <ul class="no-margin">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="post" action="{{ route('users.update', $user['id']) }}">
                @csrf
                @method('PUT')
                <label>
                    Фамилия
                    <input type="text" name="last_name" class="login__form-input @error('last_name') error @enderror"
                           value="{{ old('last_name') ?? $user['last_name'] }}">
                </label>
                <label>
                    Имя
                    <input type="text" name="first_name" class="login__form-input @error('first_name') error @enderror"
                           value="{{ old('first_name') ??$user['first_name'] }}">
                </label>
                <label>
                    Отчество
                    <input type="text" name="middle_name"
                           class="login__form-input @error('middle_name') error @enderror"
                           value="{{ old('middle_name') ?? $user['middle_name'] }}">
                </label>
                <div class="role">Тип пользователя: {{ $user->user_type->readable_name }}</div>
                <div class="dropdown-check-list mt1rem" tabindex="100">
                    <span class="anchor">Прикрепить к курсу</span>
                    <ul class="items">
                        @foreach ($unattachedCourses as $course)
                            <li><input type="checkbox" name="attachCourses[]"
                                       @if(old('attachCourses') !== null && in_array($course['id'], old('attachCourses'))) checked
                                       @endif
                                       value="{{ $course['id'] }}"/>{{ $course['title'] }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="dropdown-check-list mt1rem" tabindex="100">
                    <span class="anchor">Открепить от курса</span>
                    <ul class="items">
                        @foreach ($user->courses as $course)
                            <li><input type="checkbox" name="detachCourses[]"
                                       @if(old('detachCourses') !== null && in_array($course['id'], old('detachCourses'))) checked
                                       @endif
                                       value="{{ $course['id'] }}"/>{{ $course['title'] }}</li>
                        @endforeach
                    </ul>
                </div>
                <button  class="enter__link mt1rem">Сохранить</button>
            </form>
            <form action="{{ route('users.destroy', $user['id']) }}" method="post">
                @csrf
                @method('DELETE')
                <button  class="enter__link bg-red mt1rem">Удалить</button>
            </form>
        </div>
    </div>
@endsection
