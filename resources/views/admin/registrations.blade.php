@extends('layouts.layout')

@section('title', 'Homework System — Регистрации')

@section('header__content')
    @include('layouts.header_admin')
@endsection

@section('header__subcontent')
    <div class="header__subcontent">
        <form method="post">
            <button type="submit" name="deleteUnconfirmedUsers" class=" header__button-login  fs17">Удалить всех
                неподтвержденных пользователей
            </button>
        </form>
    </div>
@endsection

@section('main__content')
    <div class="main__content">
        хуй
    </div>
@endsection
