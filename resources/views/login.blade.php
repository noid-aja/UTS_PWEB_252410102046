@extends('layouts.app')

@section('title', 'Masuk')
@section('body-class', 'page-auth')

@section('content')
<section class="auth">
    <div class="auth-intro">
        <h1>Baca nada lagu favoritmu, langsung di senar dan pad drum.</h1>
        <p>Masuk untuk melihat tab gitar, bass, dan pola drum dari lagu rock klasik sampai grunge.</p>

        <pre class="tab-sample" aria-hidden="true">e|-----------------|
B|-----------------|
G|-0--3--5----3--0-|
D|-0--3--5----3--0-|
A|-----------------|
E|-----------------|</pre>
    </div>

    <form class="card form" method="POST" action="{{ route('login.submit') }}" novalidate>
        @csrf
        <h2>Masuk ke Musikkk</h2>

        @if ($registered)
            <div class="alert alert-ok">Pendaftaran berhasil. Silakan masuk dengan akunmu.</div>
        @endif

        <label for="username">Username</label>
        <input id="username" name="username" type="text" value="{{ old('username', $username) }}" autocomplete="username">
        @error('username') <p class="field-error">{{ $message }}</p> @enderror

        <label for="password">Password</label>
        <input id="password" name="password" type="password" autocomplete="current-password">
        @error('password') <p class="field-error">{{ $message }}</p> @enderror

        <button class="btn" type="submit">Masuk</button>
        <p class="form-foot">Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a></p>
    </form>
</section>
@endsection
