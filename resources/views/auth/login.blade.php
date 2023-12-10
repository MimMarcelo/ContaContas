@extends('layouts.master')

@section('title', 'Login')

@section('content')
<form method="POST" action="{{ route('login') }}" class="col-sm-4">
  @csrf

  <!-- Email Address -->
  <div class="form-group">
    <label for="email">E-mail</label>
    <input id="email" class="form-control" type="email" name="email" required autofocus autocomplete="username">
    {{-- <x-input-error :messages="$errors->get('email')" class="mt-2" /> --}}
  </div>

  <!-- Password -->
  <div class="form-group">
    <label for="password">Password</label>
    <input id="password" class="form-control" type="password" name="password" required autocomplete="current-password">
    {{-- <x-input-error :messages="$errors->get('password')" class="mt-2" /> --}}
  </div>

  <!-- Remember Me -->
  {{-- <div class="form-check form-switch">
    <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
    <label for="remember_me" class="form-check-label">Remember me</label>
  </div> --}}
  <input type="submit" class="btn btn-primary" value="Log in">

</form>
<div class="mt-4">
  @if (Route::has('password.request'))
    <a href="{{ route('password.request') }}">
      Forgot your password?
    </a>
  @endif
  <a class="d-block" href="{{ url('/register') }}">Don't have account, create it!</a>
</div>
@endsection
