@extends('layouts.layout')

@section('title', 'Homework System — Результат домашней работы')

@section('header__content')
    @include('layouts.header_student_teacher')
@endsection

@section('main__content')
    <div class="main__content mt4rem">
        @foreach ($attempt->inputs as $input)
            <div class="login__modal w40p  mb1rem {{ $input['is_correct'] ? 'correct' : 'wrong' }}">
                <div class="login__header">{{ $input->task->title }}</div>
                <p>{{ $input->task->description }}</p>
                <div class="role">Ответ студента: {{ $input['body'] }}</div>
                <div class="role">Правильный ответ: {{ $input->task->answer  }}</div>
                <div class="role">Количество баллов: {{ $input->task->score }}</div>
            </div>
        @endforeach

        <div class="register__modal mt1rem mb6rem">
            <a href="{{ route(Auth::user()->user_type->path . '.index')}}" class="register__modal-link">Вернуться</a>
        </div>
    </div>
@endsection
