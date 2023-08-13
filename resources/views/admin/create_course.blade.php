@extends('layouts.layout')

@section('title', 'Homework System — Создать курс')

@section('header__content')
    @include('layouts.header_admin')
@endsection

@section('main__content')
    <div class="main__content">
        <div class="login__modal mt6rem mb6rem">
            <div class="login__header">Создать курс</div>
            @if ($errors->any())
                <div class="alert alert-danger mt1rem">
                    <ul class="no-margin">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{route('course.store')}}" class="login__form" method="post">
                @csrf
                <input type="text" name="title" class="login__form-input @error('title') error @enderror"
                       placeholder="Название" value="{{ old('title') }}">
                <label class="label-input">
                    Дата начала
                    <input type="date" name="start_date"
                           class="login__form-input mt7px @error('start_date') error @enderror"
                           value="{{ old('start_date') ?? date('Y-m-d') }}">
                </label>
                <label class="label-input">
                    Дата окончания
                    <input type="date" name="end_date"
                           class="login__form-input mt7px @error('end_date') error @enderror"
                           value="{{ old('end_date') ?? date('Y-m-d') }}">
                </label>
                <label class="label-input mb16px">
                    <input type="checkbox" name="availability" @if(old('availability') !== null) checked
                        @endif>
                    Доступен
                </label>

                <label class="label-input"> Категория
                    <select name="category" class="login__form-input mt7px">
                        <option></option>
                        <option value="Естественные науки" @if(old('category')=="Естественные науки" ) selected @endif>
                            Естественные науки
                        </option>
                        <option value="Точные науки" @if(old('category')=="Точные науки" ) selected @endif>Точные
                            науки
                        </option>
                        <option value="Технические науки" @if(old('category')=="Технические науки" ) selected @endif>
                            Технические науки
                        </option>
                        <option value="Социально-гуманитарные науки"
                                @if(old('category')=="Социально-гуманитарные науки" ) selected @endif>
                            Социально-гуманитарные науки
                        </option>
                    </select>
                </label>
                <label class="label-input"> Сложность
                    <select name="difficulty_level" class="login__form-input mt7px">
                        <option></option>
                        <option value="Легкий уровень" @if(old('difficulty_level')=="Легкий уровень" ) selected @endif>
                            Легкий уровень
                        </option>
                        <option value="Средний уровень"
                                @if(old('difficulty_level')=="Средний уровень" ) selected @endif>Средний уровень
                        </option>
                        <option value="Сложный уровень"
                                @if(old('difficulty_level')=="Сложный уровень" ) selected @endif>Сложный уровень
                        </option>
                    </select>
                </label>
                <textarea name="description" class="login__form-input h200 @error('description') error @enderror"
                          maxlength="50" placeholder="Описание">{{ old('description') }}</textarea>
                <input type="hidden" name="updated_by" value="{{ $id }}">
                <button type="submit" class="enter__link">Создать</button>
            </form>
        </div>

    </div>
@endsection
