@extends('layouts.app')

@section('title', 'Profil')

@section('content')
<section class="profile">
    <div class="card profile-card">
        @if ($photo)
            <img class="avatar-img" src="{{ $photo }}" alt="Foto profil {{ $username }}">
        @else
            <div class="avatar" aria-hidden="true">{{ strtoupper(substr($username, 0, 1)) }}</div>
        @endif
        <h1>{{ $username }}</h1>
        <p class="muted">Bergabung sejak {{ $since }}</p>
    </div>

    <div class="profile-main">
        <div class="card">
            <h2>Kemampuan {{ $username }}</h2>
            <ul class="skills">
                @foreach ($skills as $skill)
                    <li>
                        <div class="skill-top">
                            <span>{{ $skill['name'] }}</span>
                            <span>{{ $skill['percent'] }}%</span>
                        </div>
                        <div class="bar"><div class="bar-fill accent-{{ $skill['color'] }}" style="width: {{ $skill['percent'] }}%"></div></div>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="card">
            <h2>Lagu favorit</h2>
            <ul class="fav">
                @foreach ($favorites as $song)
                    <li>
                        <strong>{{ $song['title'] }}</strong>
                        <span class="muted">{{ $song['artist'] }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</section>
@endsection
