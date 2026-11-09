@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<section class="hero">
    <div>
        <h1>Halo, {{ $username }}. Mau latihan lagu apa hari ini?</h1>
        <p>Semua tab dan pola drum ada di Katalog Lagu. Pilih lagu, pasang metronom, lalu mulai main.</p>
        <a class="btn" href="{{ route('pengelolaan', ['username' => $username]) }}">Buka Katalog Lagu</a>
    </div>

    <ul class="stats">
        @foreach ($stats as $stat)
            <li>
                <strong>{{ $stat['value'] }}</strong>
                <span>{{ $stat['label'] }}</span>
            </li>
        @endforeach
    </ul>
</section>

<section class="block">
    <h2>Lagu untuk dicoba dulu</h2>
    <div class="grid">
        @foreach ($featured as $song)
            <article class="card song-mini accent-{{ $song['color'] }}">
                <h3>{{ $song['title'] }}</h3>
                <p class="muted">{{ $song['artist'] }}, {{ $song['year'] }}</p>
                <p>{{ $song['desc'] }}</p>
                <p class="chips">
                    <span class="chip">{{ $song['genre'] }}</span>
                    <span class="chip">{{ $song['bpm'] }} BPM</span>
                    <span class="chip">{{ $song['level'] }}</span>
                </p>
            </article>
        @endforeach
    </div>
</section>

<section class="block">
    <h2>Cara latihan yang disarankan</h2>
    <ol class="steps">
        @foreach ($steps as $step)
            <li>{{ $step }}</li>
        @endforeach
    </ol>
</section>
@endsection
