<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Conta Conta$: @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/material-icons.css') }}">
    <script src="{{ asset('/js/jquery-3.7.1.min.js')}}"></script>
    <script src="{{ asset('/js/bootstrap.bundle.min.js')}}"></script>
</head>
<body>
    <header>
        <h1>Conta Conta$</h1>
    </header>
    <nav class="container">
        <ul class="d-flex">
            <li><a class="p-4" href="{{ url('/') }}">Home</a></li>
            <li><a class="p-4" href="{{ route('bills.index')}}">Bills</a></li>
            <li><a class="p-4" href="{{ route('bills.create')}}">Create bill</a></li>
            <li><a class="p-4" href="{{ url('/register') }}">Register</a></li>
            <li><a class="p-4" href="{{ url('/login') }}">Login</a></li>
        </ul>
    </nav>
    @if (session()->has('message'))
        <div class="container alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('message') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <main class="container">
        @yield('content')
    </main>
    <footer>
        <p>Todos os direitos reservados &copy @mimmarcelo</p>
    </footer>
</body>
</html>