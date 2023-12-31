@extends('layouts.header_main')

@section('tabs')
    <li>
        <a href="{{ route('users.index') }}"
           class="tabs-tab @if (Route::is('users.index')) tabs-tab_active @endif">Пользователи</a>
    </li>
    <li>
        <a href="{{ route('registrations.index') }}"
           class="tabs-tab @if (Route::is('registrations.index')) tabs-tab_active @endif">Регистрации</a>
    </li>
    <li>
        <a href="{{ route('course.create') }}"
           class="tabs-tab @if (Route::is('course.create')) tabs-tab_active @endif">Создание курса</a>
    </li>
    <li>
        <a href="{{ route('course_user.index') }}"
           class="tabs-tab @if (Route::is('course_user.index')) tabs-tab_active @endif">Запросы доступа</a>
    </li>
@endsection
