@extends('layouts.layout')

@section('title', 'Homework System — Регистрация')

@section('header__content')
    @include('layouts.header')
@endsection

@section('main__content')
    <div class="main__content">
        <div class="login__modal mt4rem">
            <div class="login__header fs18">Регистрация Homework System</div>
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
                <input type="number" name="id" class="login__form-input @error('id') error @enderror" placeholder="ID" value="{{ old('id') }}">
                <input type="text" name="first_name" class="login__form-input @error('first_name') error @enderror" placeholder="Имя" value="{{ old('first_name') }}">
                <input type="text" name="last_name" class="login__form-input @error('last_name') error @enderror" placeholder="Фамилия" value="{{ old('last_name') }}">
                <input type="text" name="middle_name" class="login__form-input @error('middle_name') error @enderror" placeholder="Отчество" value="{{ old('middle_name') }}">
                <input type="password" name="password" class="login__form-input @error('password') error @enderror" placeholder="Пароль">
                <input type="password" name="password_confirmation" class="login__form-input @error('password_confirmation') error @enderror" placeholder="Повторите пароль">

                <div class="radio">
                    <label class="radio-label">
                        <input type="radio" name="user_type_id" @if(old('user_type_id')==2) checked @endif value="2">
                        Ученик
                    </label>
                    <label class="radio-label">
                        <input type="radio" name="user_type_id" @if(old('user_type_id')==3) checked @endif value="3">
                        Преподаватель
                    </label>
                </div>
                <label class="label-input fs15 mb16px">
                    <input type="checkbox" name="policy" checked="checked">
                    Я согласен(а) с <a class="policy" href="{{ route('policy') }}">политикой конфиденциальности</a>
                </label>
                <button  class="register__modal-link">Зарегистрироваться</button>
            </form>
        </div>
        <div class="register__modal mt1rem mb6rem">
            <div class="register__header">Или</div>
            <a href="{{ route('login') }}" class="enter__link">Войти</a>
        </div>
    </div>
@endsection
