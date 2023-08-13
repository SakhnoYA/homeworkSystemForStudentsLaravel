@extends('layouts.layout')

@section('title', 'Homework System — Регистрации')

@section('header__content')
    @include('layouts.header_admin')
@endsection

@section('header__subcontent')
    <div class="header__subcontent">
        <form action="{{ route('registrations.destroyAll') }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class=" header__button-login  fs17">
                Удалить всех
                неподтвержденных пользователей
            </button>
        </form>
    </div>
@endsection

@section('main__content')
    <div class="main__content">
        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="login__modal mt6rem mb6rem width-auto dark-slay-gray padding-20-20">
            @if ($users->count()==0)
                Неподтвержденные регистрации отсутствуют
            @else
                <table class="tg">
                    <thead>
                    <tr>
                        <th class="tg-amwm">ID</th>
                        <th class="tg-amwm">Время регистрации</th>
                        <th class="tg-amwm">Имя</th>
                        <th class="tg-amwm">Фамилия</th>
                        <th class="tg-amwm">Отчество</th>
                        <th class="tg-amwm">Тип пользователя</th>
                        <th class="tg-amwm"></th>
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
                            <td class="{{ $rowClass }}">
                                <form method="post" action="{{ route('registrations.update', $user['id']) }}">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="is_confirmed" value="true">
                                    <button type="submit" class="table-button">Подтвердить</button>
                                </form>
                            </td>
                            <td class="{{ $rowClass }}">
                                <form action="{{ route('registrations.destroy', $user['id']) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="table-button">Удалить</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
        {{ $users->appends(request()->input())->links() }}
    </div>
@endsection
