<div class="header__content">
    <img src="{{ Vite::asset('resources/images/icon.png') }}" class="header-logo" alt="Homework System logo">
    <ul class="tabs">
        @yield('tabs')
    </ul>
    <div>
        <a href="{{ route('logout') }}" class="header__button-login">Выйти</a>
    </div>
    @if(Auth::user()->image != '')
        <img src="{{ asset('storage/avatar') }}" class="image-profile" alt="User profile photo">
    @endif
</div>
