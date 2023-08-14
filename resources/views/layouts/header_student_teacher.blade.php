@extends('layouts.header_main')

@section('tabs')
    <li>
        <a href="{{ route(Auth::user()->user_type->path . '.index') }}"
           class="tabs-tab @if (Route::is(Auth::user()->user_type->path . '.index')) tabs-tab_active @endif">Курсы</a>
    </li>
    <li>
        <a href="{{ route('access_request.index') }}"
           class="tabs-tab @if (Route::is('access_request.index')) tabs-tab_active @endif">Запросить доступ</a>
    </li>
@endsection
