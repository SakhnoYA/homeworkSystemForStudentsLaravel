@extends('layouts.layout')

@section('title', 'Homework System — Вход')

@section('header__content')
    @include('layouts.header')
@endsection

@section('main__content')
    @env('local')
        <div class="main__content">
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="login__modal mt4rem">
                <div class="login__header">Вход Homework System</div>
                @if ($errors->any())
                    <div class="alert alert-danger mt1rem">
                        <ul class="no-margin">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{route('login.store')}}" class="login__form" method="post">
                    @csrf
                    <input type="number" name="login" class="login__form-input" placeholder="ID админа 7345">
                    <input type="password" name="password" class="login__form-input" placeholder="Пароль админа 7345">
                    <label class="label-input fs18 mb16px">
                        <input type="checkbox" name="remember" checked="checked" value="1">
                        Запомнить меня
                    </label>
                    <button type="submit" name="toEnter" class="enter__link">Войти</button>
                </form>

            </div>
            <div class="register__modal mt1rem mb4rem">
                <div class="register__header">Или</div>
                <a href="{{ route('registration') }}" class="register__modal-link">Зарегистрироваться</a>
            </div>
        </div>
    @endenv

    @production
        <div class="main__content" style="color: white">
            Система переписывается на Laravel
            <a href="https://hwsysold.sakhnoya.ru/">Старая версия </a>
        </div>
    @endproduction
@endsection
