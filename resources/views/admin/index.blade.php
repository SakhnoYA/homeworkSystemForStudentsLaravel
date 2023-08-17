@extends('layouts.layout')

@section('title', 'Homework System — Пользователи')

@section('header__content')
    @include('layouts.header_admin')
@endsection

@section('header__subcontent')
    <div class="header__subcontent">
        <div>
            <a href="{{ route('users.index') }}" class="header__button-login bd-none fw300 fs17">Все
                пользователи
            </a>
            <a href="{{ route('users.index', ['type'=>3]) }}" class="header__button-login bd-none fw300 fs17">
                Преподаватели
            </a>
            <a href="{{ route('users.index', ['type'=>2]) }}" class="header__button-login bd-none fw300 fs17">Студенты
            </a>
        </div>
        <div>
            <a href="{{route('users.create')}}" class="header__button-login  fs17">
                Создать нового пользователя
            </a>
        </div>
    </div>
@endsection

@section('main__content')
    <div class="main__content">
        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="login__modal mt2rem mb1rem width-auto dark-slay-gray padding-20-20">
            <table class="tg">
                <thead>
                <tr>
                    <th class="tg-amwm">ID</th>
                    <th class="tg-amwm">Время регистрации</th>
                    <th class="tg-amwm">Имя</th>
                    <th class="tg-amwm">Фамилия</th>
                    <th class="tg-amwm">Отчество</th>
                    <th class="tg-amwm">Тип пользователя</th>
                    <th class="tg-amwm">Ip</th>
                    <th class="tg-amwm">Подтверждение</th>
                    <th class="tg-amwm"></th>
                </tr>
                </thead>
                <tbody>
                @php $isOdd = true; @endphp
                @foreach ($users as $user)
                    @php
                        $rowClass = $isOdd ? 'tg-0lax' : 'tg-hmp3';
                        $isOdd = !$isOdd;
                    @endphp
                    <tr>
                        <td class="{{ $rowClass }}">{{ $user['id'] }}</td>
                        <td class="{{ $rowClass }}">{{ date('Y-m-d H:i', strtotime($user['created_at'])) }}</td>
                        <td class="{{ $rowClass }}">{{ $user['first_name'] }}</td>
                        <td class="{{ $rowClass }}">{{ $user['last_name'] }}</td>
                        <td class="{{ $rowClass }}">{{ $user['middle_name'] }}</td>
                        <td class="{{ $rowClass }}">{{ $user->user_type->readable_name }}</td>
                        <td class="{{ $rowClass }}">{{ $user['ip'] }}</td>
                        <td class="{{ $rowClass }}">{{ $user['is_confirmed'] ? 'Имеется' : 'Отсутствует' }}</td>
                        <td class="{{ $rowClass }}">
                            <a class="table-button" href="{{ route('users.edit', $user['id']  ) }}">Профиль</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{ $users->appends(request()->input())->links() }}
    </div>
@endsection
