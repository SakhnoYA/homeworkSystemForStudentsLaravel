@extends('layouts.layout')

@section('title', 'Homework System — Создать пользователя')

@section('script')
    @vite('resources/js/checklist.js')
@endsection

@section('header__content')
    @include('layouts.header_admin')
@endsection

@section('main__content')
    <div class="main__content">
        <div class="login__modal mt6rem mb6rem">
            <div class="login__header fs18">Профиль</div>
            @if ($errors->any())
                <div class="alert alert-danger mt1rem">
                    <ul class="no-margin">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form class="login__form" method="post" action="{{ route('registration.store') }}">
                @csrf
                <input type="number" name="id" class="login__form-input @error('id') error @enderror" placeholder="ID"
                       value="{{ old('id') }}">
                <input type="text" name="first_name" class="login__form-input @error('first_name') error @enderror"
                       placeholder="Имя" value="{{ old('first_name') }}">
                <input type="text" name="last_name" class="login__form-input @error('last_name') error @enderror"
                       placeholder="Фамилия" value="{{ old('last_name') }}">
                <input type="text" name="middle_name" class="login__form-input @error('middle_name') error @enderror"
                       placeholder="Отчество" value="{{ old('middle_name') }}">
                <input type="password" name="password" id="password"
                       class="login__form-input @error('password') error @enderror" placeholder="Пароль">
                <input type="password" name="password_confirmation"
                       class="login__form-input @error('password_confirmation') error @enderror"
                       placeholder="Повторите пароль">
                <div class="dropdown-check-list mb1rem" tabindex="100">
                    <span class="anchor">Прикрепить к курсу</span>
                    <ul class="items">
                        @foreach ($courses as $course)
                            <li><input type="checkbox" name="attachCourses[]"
                                       value="{{ $course['id'] }}"/>{{ $course['title'] }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="radio">
                    <label class="radio-label">
                        <input type="radio" name="user_type_id" checked value="2">
                        Ученик
                    </label>
                    <label class="radio-label">
                        <input type="radio" name="user_type_id" value="3">
                        Преподаватель
                    </label>
                </div>
                <label class="label-input fs15 mb16px">
                    <input type="checkbox" name="policy" checked="checked">
                    Я согласен(а) с <a class="policy" href="{{ route('policy') }}">политикой конфиденциальности</a>
                </label>
                <input type="hidden" name="is_confirmed" value="true">
                <button type="submit" class="register__modal-link">Создать</button>
            </form>
        </div>

    </div>
@endsection
