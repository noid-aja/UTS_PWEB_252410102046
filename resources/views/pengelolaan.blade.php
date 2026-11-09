@extends('layouts.app')

@section('title', 'Katalog Lagu')

@section('content')
<section class="page-head">
    <h1>Katalog Lagu</h1>
    <p>Klik tombol <strong>Lihat tab lengkap</strong> pada lagu untuk membuka notenya. Angka pada tab adalah nomor fret, huruf x dan o pada drum adalah pukulan.</p>
</section>

<section class="songs">
    @foreach ($songs as $song)
        <article class="card song accent-{{ $song['color'] }}">
            <header class="song-head">
                <div>
                    <h2>{{ $song['title'] }}</h2>
                    <p class="muted">{{ $song['artist'] }}, {{ $song['year'] }}</p>
                </div>
                <p class="chips">
                    <span class="chip">{{ $song['genre'] }}</span>
                    <span class="chip">{{ $song['bpm'] }} BPM</span>
                    <span class="chip">Kunci {{ $song['key'] }}</span>
                    <span class="chip">{{ $song['level'] }}</span>
                </p>
            </header>

            <p>{{ $song['desc'] }}</p>

            <details class="song-details">
                <summary>Lihat tab lengkap</summary>

                <div class="switcher" role="group" aria-label="Pilih instrumen">
                    @foreach ($song['instruments'] as $key => $label)
                        <button type="button" class="switch {{ $loop->first ? 'is-on' : '' }}" data-inst="{{ $key }}">{{ $label }}</button>
                    @endforeach
                </div>

                @foreach ($song['instruments'] as $key => $label)
                    <div class="inst-panel {{ $loop->first ? '' : 'is-hidden' }}" data-panel="{{ $key }}">
                        <h3>{{ $label }}</h3>
                        <p class="muted">{{ $song[$key]['title'] }}</p>
                        <pre class="tab">{{ $song[$key]['tab'] }}</pre>
                        @if (!empty($song[$key]['tip']))
                            <p class="tip">{{ $song[$key]['tip'] }}</p>
                        @endif
                    </div>
                @endforeach
            </details>
        </article>
    @endforeach
</section>
@endsection

@section('scripts')
<script>
    // Tiap lagu punya tombol instrumen sendiri
    document.querySelectorAll('.song').forEach((song) => {
        const buttons = song.querySelectorAll('.switch');
        const panels = song.querySelectorAll('.inst-panel');

        buttons.forEach((btn) => {
            btn.addEventListener('click', () => {
                const inst = btn.dataset.inst;

                buttons.forEach((b) => b.classList.toggle('is-on', b === btn));
                panels.forEach((p) => p.classList.toggle('is-hidden', p.dataset.panel !== inst));
            });
        });
    });
</script>
@endsection
