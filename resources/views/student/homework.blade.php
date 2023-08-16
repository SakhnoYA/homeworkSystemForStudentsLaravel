@extends('layouts.layout')

@section('title', 'Homework System — Домашнее задание')

@section('header__content')
    @include('layouts.header_student_teacher')
@endsection

@section('main__content')
    <div class="main__content mt4rem">
        <form method="post" class="w40p mt1rem mb6rem" action="{{route('attempt.store')}}">
            @csrf
            @foreach ($homework->tasks as $index=>$task)
                @php
                    preg_match_all('/("[^"]*"|\S+)/u',  $task['options'], $matches);
                @endphp
                <div class="login__modal width-initial mb1rem">
                    <div class="login__header">{{ $task['title'] }}</div>
                    <p>{{ $task['description'] }}</p>
                    @if ($task['type'] === 'single_choice')
                        <div class="radio flex-radio">
                            @foreach (array_map(fn ($word) => str_replace('"', '', $word), $matches[0]) as $option)
                                <label class="radio-label mb5px">
                                    <input type="radio" name={{"body" . $index}} value="{{ $option }}">
                                    {{ $option }}
                                </label>
                            @endforeach
                        </div>
                    @elseif ($task['type'] === 'multiple_choice')
                        <div class="radio flex-radio">
                            @foreach (array_map(fn ($word) => str_replace('"', '', $word), $matches[0]) as $option)
                                <label class="label-input mb5px">
                                    <input type="checkbox" name={{"body". $index . "[]" }} value="{{ $option }}">
                                    {{ $option }}
                                </label>
                            @endforeach
                        </div>
                    @else
                        <input type="text" class="login__form-input" name={{"body" . $index}} placeholder="Ответ">
                    @endif
                    @if (isset($task['score']))
                        <div class="role">Количество баллов: {{ $task['score'] }}</div>
                    @endif
                    <input type="hidden" name={{"task_id". $index}} value="{{ $task['id'] }}">
                </div>
            @endforeach
            <div class="register__modal width-initial">
                <input type="hidden" name="homework_id" value="{{ $homework->id }}">
                <input type="hidden" name="course_id" value="{{ $course_id}}">
                <button class="register__modal-link">Отправить</button>
            </div>
        </form>
    </div>
@endsection
