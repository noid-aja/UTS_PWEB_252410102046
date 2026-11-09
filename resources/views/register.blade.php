@extends('layouts.app')

@section('title', 'Daftar')
@section('body-class', 'page-auth')

@section('content')
<section class="auth auth-single">
    <form class="card form" method="POST" action="{{ route('register.submit') }}" novalidate>
        @csrf
        <h2>Buat akun Musikkk</h2>
        <p class="muted">Hanya TESSSSSSS.</p>

        <label for="username">Username</label>
        <input id="username" name="username" type="text" value="{{ old('username') }}" autocomplete="username">
        @error('username') <p class="field-error">{{ $message }}</p> @enderror

        <label for="email">Email</label>
        <input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email">
        @error('email') <p class="field-error">{{ $message }}</p> @enderror

        <label for="password">Password</label>
        <input id="password" name="password" type="password" autocomplete="new-password">
        @error('password') <p class="field-error">{{ $message }}</p> @enderror

        <label for="password_confirmation">Ulangi password</label>
        <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password">

        <button class="btn" type="submit">Daftar</button>
        <p class="form-foot">Sudah punya akun? <a href="{{ route('login') }}">Masuk</a></p>
    </form>
</section>
@endsection
