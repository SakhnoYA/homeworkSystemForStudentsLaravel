@extends('layouts.layout')

@section('title', 'Homework System — Запросы доступа')

@section('header__content')
    @include('layouts.header_admin')
@endsection

@section('main__content')
    <div class="main__content">
        <div class="login__modal mt6rem mb6rem width-auto dark-slay-gray padding-20-20">
            @if ($courseRelationships->count()==0)
                Запросы доступа к курсам отсутствуют
            @else
                <table class="tg">
                    <thead>
                    <tr>
                        <th class="tg-amwm">ID</th>
                        <th class="tg-amwm">Имя</th>
                        <th class="tg-amwm">Фамилия</th>
                        <th class="tg-amwm">Отчество</th>
                        <th class="tg-amwm">Тип пользователя</th>
                        <th class="tg-amwm">Курс</th>
                        <th class="tg-amwm"></th>
                        <th class="tg-amwm"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $isOdd = true; @endphp
                    @foreach ($courseRelationships as $courseRelationship)
                        @foreach ($courseRelationship->users as $user)
                            @php
                                $rowClass = $isOdd ? 'tg-0lax' : 'tg-hmp3';
                                $isOdd = !$isOdd;
                            @endphp
                            <tr>
                                <td class="{{ $rowClass }}">{{ $user['id'] }}</td>
                                <td class="{{ $rowClass }}">{{ $user['first_name'] }}</td>
                                <td class="{{ $rowClass }}">{{ $user['last_name'] }}</td>
                                <td class="{{ $rowClass }}">{{ $user['middle_name'] }}</td>
                                <td class="{{ $rowClass }}">{{ $user->user_type->readable_name }}</td>
                                <td class="{{ $rowClass }}">{{ $courseRelationship['title'] }}</td>
                                <td class="{{ $rowClass }}">
                                    <form action="{{ route('course_user.update', $user['id']) }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="course_id" value="{{ $courseRelationship['id'] }}">
                                        <button type="submit" class="table-button">Подтвердить</button>
                                    </form>
                                </td>
                                <td class="{{ $rowClass }}">
                                    <form action="{{ route('course_user.destroy', $user['id']) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="course_id" value="{{ $courseRelationship['id'] }}">
                                        <button type="submit" class="table-button">Отклонить</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
        {{ $courseRelationships->appends(request()->input())->links() }}
    </div>
@endsection
