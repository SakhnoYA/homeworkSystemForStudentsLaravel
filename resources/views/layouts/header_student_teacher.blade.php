@extends('layouts.header_main')

@section('tabs')
    <li>
{{--        <a href="{{ route(Auth::user()->user_type->name . '.index') }}"--}}
{{--           class="tabs-tab @if (Route::is(Auth::user()->user_type->name . '.index')) tabs-tab_active @endif">Курсы</a>--}}
    </li>
    <li>
{{--        <a href="{{ route('registrations.index') }}"--}}
{{--           class="tabs-tab @if (Route::is('registrations.index')) tabs-tab_active @endif">Запросить доступ</a>--}}
    </li>
@endsection
