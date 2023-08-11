@extends('layouts.layout')

@section('title', '404: Страница не найдена')

@section('script')
    <script defer>
        setTimeout(function () {
            window.location.href = "{{ route('login') }}"
        }, 4000)
    </script>
@endsection

@section('header__content')
    @include('layouts.header')
@endsection

@section('main__content')
    <div class="main__content">
        <div class="login__modal mt6rem">
            <div class="login__header">404: Страница не найдена</div>
        </div>
        <div class="register__modal mt1rem ">
            <a href="{{route('login')}}" class="enter__link">На главную</a>
        </div>
    </div>
@endsection
