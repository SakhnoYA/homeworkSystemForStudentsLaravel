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
                <form action="" class="login__form" method="post">
                    <input type="number" name="login" class="login__form-input" placeholder="ID админа 7345">
                    <input type="password" name="password" class="login__form-input" placeholder="Пароль админа 7345">
                    <button type="submit" name="toEnter" class="enter__link">Войти</button>
                </form>
                <?php
                if (!empty($error)) : ?>
                <p class="errorMessage"><?= $error ?></p>
                <?php
                endif; ?>
            </div>
            <div class="register__modal mt1rem">
                <div class="register__header">Или</div>
                <a href="{{ route('registration') }}" class="register__modal-link">Зарегистрироваться</a>
            </div>
        </div>
    @endenv

    @production
        <div class="main__content">
            Система переписывается на Laravel
            <a href="https://hwsysold.sakhnoya.ru/">Старая версия </a>
        </div>
    @endproduction
@endsection
