<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Management</title>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Your custom CSS -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
<div class="container">
<a class="navbar-brand" href="{{ url('/') }}">
User Management
</a>
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarSupportedContent">
<ul class="navbar-nav ms-auto">
@guest
<li class="nav-item">
<a class="nav-link" href="{{ route('login') }}">Login</a>
</li>
<li class="nav-item">
<a class="nav-link" href="{{ route('register') }}">Register</a>
</li>
@else
<li class="nav-item">
<a class="nav-link" href="{{ url('/users') }}">Users Management</a>
</li>
<li class="nav-item">
<a class="nav-link" href="#">{{ Auth::user()->name }}</a>
</li>
<li class="nav-item">
<a class="nav-link" href="{{ route('logout') }}"
onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
Logout
</a>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
@csrf
</form>
</li>
@endguest
</ul>
</div>
</div>
</nav>
<main class="py-4">
@yield('content')
</main>
</div>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- Your custom JS -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
