<div class="header__content">
    <img src="{{ Vite::asset('resources/images/icon.png') }}" class="header-logo" alt="Homework System logo">
    <ul class="tabs">
        <li>
            <a href="{{ route('admin.index') }}" class="tabs-tab @if (Route::is('admin.index')) tabs-tab_active @endif">Пользователи</a>
        </li>
        <li>
            <a href="{{ route('admin.registrations') }}" class="tabs-tab @if (Route::is('admin.registrations')) tabs-tab_active @endif">Регистрации</a>
        </li>
        <li>
            <a href="{{ route('admin.create_course') }}" class="tabs-tab @if (Route::is('admin.create_course')) tabs-tab_active @endif">Создание курса</a>
        </li>
        <li>
            <a href="{{ route('admin.access_requests') }}" class="tabs-tab @if (Route::is('admin.access_requests')) tabs-tab_active @endif">Запросы доступа</a>
        </li>
    </ul>
    <form method="post">
        <button type="submit" name="logout" class="header__button-login">Выйти</button>
    </form>
</div>
