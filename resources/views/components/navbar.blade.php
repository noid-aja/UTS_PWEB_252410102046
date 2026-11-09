@props(['username' => null])

<header class="navbar">
    <div class="navbar-inner">
        <a class="brand" href="{{ $username ? route('dashboard', ['username' => $username]) : route('login') }}">
            <span class="brand-mark" aria-hidden="true">
                <i></i><i></i><i></i><i></i>
            </span>
            Musikkk
        </a>

        @if ($username)
            <nav class="nav-links" aria-label="Menu utama">
                <a href="{{ route('dashboard', ['username' => $username]) }}"
                   class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
                <a href="{{ route('pengelolaan', ['username' => $username]) }}"
                   class="{{ request()->routeIs('pengelolaan') ? 'active' : '' }}">Katalog Lagu</a>
                <a href="{{ route('profile', ['username' => $username]) }}"
                   class="{{ request()->routeIs('profile') ? 'active' : '' }}">Profil</a>
                <a href="{{ route('logout') }}" class="nav-logout">Keluar</a>
            </nav>
        @endif
    </div>
</header>
