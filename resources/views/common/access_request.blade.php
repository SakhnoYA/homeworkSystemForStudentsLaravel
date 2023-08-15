@extends('layouts.layout')

@section('title', 'Homework System — Запрос доступа')

@section('script')
    @vite('resources/js/checklist.js')
@endsection

@section('header__content')
    @include('layouts.header_student_teacher')
@endsection

@section('main__content')
    <div class="main__content">
        <div class="login__modal mt6rem mb6rem">
            <div class="login__header fs18">Запрос</div>
            <form action="{{ route('access_request.update',Auth::id())  }}" class="login__form accessRequestForm"
                  method="post">
                @csrf
                @method('PUT')
                <div class="dropdown-check-list" tabindex="100">
                    <span class="anchor">Прикрепить к курсу</span>
                    <ul class="items">
                        @foreach ($unattachedCourses as $course)
                            <li><input type="checkbox" name="attachCourses[]"
                                       value="{{ $course['id'] }}"/>{{ $course['title'] }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="dropdown-check-list mt1rem mb1rem" tabindex="100">
                    <span class="anchor">Открепить от курса</span>
                    <ul class="items">
                        @foreach ($user->courses as $course)
                            <li><input type="checkbox" name="detachCourses[]"
                                       value="{{ $course['id'] }}"/>{{ $course['title'] }}</li>
                        @endforeach
                    </ul>
                </div>
                <button  class="register__modal-link">Отправить</button>
            </form>
        </div>
    </div>
@endsection
