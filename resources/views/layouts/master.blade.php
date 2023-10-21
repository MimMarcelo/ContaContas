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
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Bills
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <li><a class="dropdown-item" href="{{ route('bills.index')}}">List</a></li>
                  <li><a class="dropdown-item" href="{{ route('bills.create')}}">Create</a></li>
                </ul>
              </li>
              @if (Auth::check())
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <li><a class="dropdown-item" href="{{ route('profile.edit')}}">Profile</a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <input class="dropdown-item" type="submit" value="Log out">
                        </form>
                    </li>
                    </ul>
                </li>
              @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/register') }}">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/login') }}">Login</a>
                    </li>
              @endif
              
            </ul>
          </div>
        </div>
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