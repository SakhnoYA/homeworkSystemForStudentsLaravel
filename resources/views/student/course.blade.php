@extends('layouts.layout')

@section('title', 'Homework System — Курс')

@section('header__content')
    @include('layouts.header_student_teacher')
@endsection

@section('main__content')
    <div class="main__content padding-0-200">
        <div class="login__modal mt6rem mb6rem width-auto dark-slay-gray padding-20-20">
            @if ($course->homeworks->count()==0)
                Домашние задания отсутствуют
            @else
                <table class="tg">
                    <thead>
                    <tr>
                        <th class="tg-amwm">Название</th>
                        <th class="tg-amwm">Описание</th>
                        <th class="tg-amwm">Всего попыток</th>
                        <th class="tg-amwm">Всего баллов</th>
                        <th class="tg-amwm">Проходные баллы</th>
                        <th class="tg-amwm">Дата начала</th>
                        <th class="tg-amwm">Дата конца</th>
                        <th class="tg-amwm"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $isOdd = true; @endphp
                    @foreach ($course->homeworks as $homework)
                        @php $rowClass = $isOdd ? 'tg-0lax' : 'tg-hmp3'; @endphp
                        @php $isOdd = !$isOdd; @endphp
                        <tr>
                            <td class="{{ $rowClass }}">{{ $homework['title'] }}</td>
                            <td class="{{ $rowClass }}">{{ $homework['description'] }}</td>
                            <td class="{{ $rowClass }}">{{ $homework['max_attempts'] }}</td>
                            <td class="{{ $rowClass }}">{{ $homework['total_marks'] }}</td>
                            <td class="{{ $rowClass }}">{{ $homework['passing_marks'] }}</td>
                            <td class="{{ $rowClass }}">{{ $homework['start_date'] }}</td>
                            <td class="{{ $rowClass }}">{{ $homework['end_date'] }}</td>
                            <td class="{{ $rowClass }}">
                                @if( isset($homework['end_date']) && $homework['end_date'] < now())
                                    <div class="table-button">Дедлайн пройден</div>
                                @elseif($homework->tasks()->count()==0)
                                    <div class="table-button">Отсутствуют задачи</div>
                                @elseif ($homework->attempts()->where('user_id', $id)->count() <  $homework['max_attempts'])
                                    <a href="{{ route('homework.index', ['homework_id'=>$homework['id'], 'course_id'=>$course['id']]) }}"
                                       class="table-button">Решать</a>
                                @else
                                    <div class="table-button">Попытки закончились</div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>

    </div>
@endsection
