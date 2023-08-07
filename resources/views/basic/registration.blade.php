@extends('layouts.layout')

@section('title', 'Homework System — Регистрация')

@section('header__content')
    @include('layouts.header')
@endsection

@section('main__content')
    <div class="main__content">
        <div class="login__modal mt4rem">
            <div class="login__header fs18">Регистрация Homework System</div>
            <form class="login__form" method="post">
                <input type="number" name="id" class="login__form-input" placeholder="ID" required>
                <input type="text" name="first_name" class="login__form-input" placeholder="Имя" required>
                <input type="text" name="last_name" class="login__form-input" placeholder="Фамилия" required>
                <input type="text" name="middle_name" class="login__form-input" placeholder="Отчество">
                <input type="password" name="password" id="password" class="login__form-input" placeholder="Пароль"
                       required>

                <div class="radio">
                    <label class="radio-label">
                        <input type="radio" name="type" required checked value="2">
                        Ученик
                    </label>
                    <label class="radio-label">
                        <input type="radio" name="type" required value="3">
                        Преподаватель
                    </label>
                </div>
                <label class="label-input fs15 mb16px">
                    <input type="checkbox" required checked="checked">
                    Я согласен(а) с <a class="policy" href="{{ route('policy') }}">политикой конфиденциальности</a>
                </label>
                <button type="submit" class="register__modal-link">Зарегистрироваться</button>
            </form>
        </div>
        <div class="register__modal mt1rem mb6rem">
            <div class="register__header">Или</div>
            <a href="{{ route('home') }}" class="enter__link">Войти</a>
        </div>
    </div>
@endsection
