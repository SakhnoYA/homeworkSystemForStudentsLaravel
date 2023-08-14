<div class="header__content">
    <img src="{{ Vite::asset('resources/images/icon.png') }}" class="header-logo" alt="Homework System logo">
    <ul class="tabs">
        <li>
            <a href="{{ route('admin.index') }}"
               class="tabs-tab @if (Route::is('admin.index')) tabs-tab_active @endif">Пользователи</a>
        </li>
        <li>
            <a href="{{ route('registrations.index') }}"
               class="tabs-tab @if (Route::is('registrations.index')) tabs-tab_active @endif">Регистрации</a>
        </li>
        <li>
            <a href="{{ route('course.create') }}"
               class="tabs-tab @if (Route::is('course.create')) tabs-tab_active @endif">Создание курса</a>
        </li>
        <li>
            <a href="{{ route('course_user.index') }}"
               class="tabs-tab @if (Route::is('course_user.index')) tabs-tab_active @endif">Запросы доступа</a>
        </li>
    </ul>
    <a href="{{ route('logout') }}" class="header__button-login">Выйти</a>
</div>
