@extends('layouts.layout')

@section('title', 'Homework System — Пользователи')

@section('header__content')
    @include('layouts.header_admin')
@endsection

@section('header__subcontent')
    <div class="header__subcontent">
        <form method="get">
            <button type="submit" name="type" value="0" class="header__button-login bd-none fw300 fs17">Все
                пользователи
            </button>
            <button type="submit" name="type" value="3" class="header__button-login bd-none fw300 fs17">
                Преподаватели
            </button>
            <button type="submit" name="type" value="2" class="header__button-login bd-none fw300 fs17">Студенты
            </button>
        </form>
        <a href="{{route('admin.create_user')}}">
            <button type="submit" class=" header__button-login  fs17"> Создать нового пользователя</button>
        </a>
    </div>
@endsection

@section('main__content')
    <div class="main__content">
        хуй
    </div>
@endsection
