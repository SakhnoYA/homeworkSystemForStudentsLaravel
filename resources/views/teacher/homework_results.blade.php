@extends('layouts.layout')

@section('title', 'Homework System — Результаты студентов')

@section('header__content')
    @include('layouts.header_student_teacher')
@endsection

@section('main__content')
    <div class="main__content padding-0-200">
        <div class="login__modal mt6rem mb6rem width-auto dark-slay-gray padding-20-20">
            @if (count($attempts)==0)
                Попытки отсутствуют
            @else
                <table class="tg">
                    <thead>
                    <tr>
                        <th class="tg-amwm">Студент</th>
                        <th class="tg-amwm">Попытка</th>
                        <th class="tg-amwm">Баллы</th>
                        <th class="tg-amwm">Время</th>
                        <th class="tg-amwm"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $isOdd = true;
                    @endphp
                    @foreach ($attempts as $attempt)
                        @php
                            $rowClass = $isOdd ? 'tg-0lax' : 'tg-hmp3';
                            $isOdd = !$isOdd;
                        @endphp
                        <tr>
                            <td class="{{ $rowClass }}">{{ $attempt->user->fullName }}</td>
                            <td class="{{ $rowClass }}">{{ $attempt['row_number'] }}</td>
                            <td class="{{ $rowClass }}">{{ $attempt['score'] }}</td>
                            <td class="{{ $rowClass }}">{{ date('Y-m-d H:i', strtotime($attempt['submission_time'])) }}</td>
                            <td class="{{ $rowClass }}">
                                <a href="{{route('attempt.show',$attempt['id'])}}" class="table-button">
                                    Смотреть
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
        {{ $attempts->appends(request()->input())->links() }}
    </div>
@endsection
