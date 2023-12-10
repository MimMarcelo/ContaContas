@extends('layouts.master')

@section('title', 'Login')

@section('content')
<form method="POST" action="{{ route('register') }}">
  @csrf

  <!-- Name -->
  <div class="form-group">
    <label for="name">Name</label>
    <input id="name" class="form-control" type="text" name="name" required autofocus autocomplete="name">
    {{-- <x-input-error :messages="$errors->get('name')" class="mt-2" /> --}}
  </div>

  <!-- Email Address -->
  <div class="form-group">
    <label for="email">e-mail</label>
    <input id="email" class="form-control" type="email" name="email" required autocomplete="username">
    {{-- <x-input-error :messages="$errors->get('email')" class="mt-2" /> --}}
  </div>

  <!-- Password -->
  <div class="form-group" class="mt-4">
    <label for="password">Password</label>

    <input id="password" class="form-control"
                    type="password"
                    name="password"
                    required autocomplete="new-password">

    {{-- <x-input-error :messages="$errors->get('password')" class="mt-2" /> --}}
  </div>

  <!-- Confirm Password -->
  <div class="form-group" class="mt-4">
    <label for="password_confirmation">Confirm Password</label>

    <input id="password_confirmation" class="form-control"
                    type="password"
                    name="password_confirmation" required autocomplete="new-password">

    {{-- <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" /> --}}
  </div>

  <input type="submit" class="btn btn-primary" value="Register">
</form>
<div class="mt-4">
  <a href="{{ route('login') }}">Already registered? Login</a>
</div>
@endsection