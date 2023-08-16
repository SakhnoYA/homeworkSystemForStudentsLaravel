@extends('layouts.layout')

@section('title', 'Homework System — Курсы')

@section('header__content')
    @include('layouts.header_student_teacher')
@endsection

@section('main__content')
    <div class="main__content padding-0-200">
        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="login__modal mt6rem mb6rem width-auto dark-slay-gray padding-20-20 ">
            @if ($confirmedAttachedCourses->count()==0)
                Прикрепления к курсам отсутствуют. Пожалуйста, запросите доступ.
            @else
                <table class="tg">
                    <thead>
                    <tr>
                        <th class="tg-amwm">Название</th>
                        <th class="tg-amwm">Описание</th>
                        <th class="tg-amwm">Дата начала</th>
                        <th class="tg-amwm">Дата конца</th>
                        <th class="tg-amwm">Уровень сложности</th>
                        <th class="tg-amwm">Категория</th>
                        <th class="tg-amwm"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $isOdd = true;
                    @endphp
                    @foreach ($confirmedAttachedCourses as $course)
                        @php
                            $rowClass = $isOdd ? 'tg-0lax' : 'tg-hmp3';
                            $isOdd = !$isOdd;
                        @endphp
                        <tr>
                            <td class="{{ $rowClass }}">{{ $course['title'] }}</td>
                            <td class="{{ $rowClass }}">{{ $course['description'] }}</td>
                            <td class="{{ $rowClass }}">{{ $course['start_date'] }}</td>
                            <td class="{{ $rowClass }}">{{ $course['end_date'] }}</td>
                            <td class="{{ $rowClass }}">{{ $course['difficulty_level'] }}</td>
                            <td class="{{ $rowClass }}">{{ $course['category'] }}</td>
                            <td class="{{ $rowClass }}">
                                @if( isset($course['end_date']) && $course['end_date'] < now())
                                    <div class="table-button">Курс завершен</div>
                                @else
                                    <a href=" {{route('course.show',$course['id'])}}" class="table-button">Перейти</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
        {{ $confirmedAttachedCourses->appends(request()->input())->links() }}
    </div>
@endsection
