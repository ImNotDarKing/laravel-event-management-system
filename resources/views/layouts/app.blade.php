<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Event Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/css/app.css'])
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light px-3">
        <a class="navbar-brand" href="{{ url('/') }}">Events</a>

        @auth
            <div class="ms-auto">
                @if(auth()->user()->role === 'organizer')
                    <a class="btn btn-outline-primary me-2" href="{{ route('organizer.events.index') }}">My Events</a>
                @endif

                @if(auth()->user()->role === 'admin')
                    <a class="btn btn-outline-danger me-2" href="{{ route('admin.events.index') }}">Admin Panel</a>
                @endif

                @if(auth()->user()->role==='visitor')
                    <a class="btn btn-outline-info me-2" href="{{ route('profile.events') }}">Мои события</a>
                @endif

                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button class="btn btn-outline-secondary">Logout</button>
                </form>
            </div>
        @else
            <div class="ms-auto">
                <a class="btn btn-outline-success me-2" href="{{ route('login') }}">Login</a>
                <a class="btn btn-outline-primary" href="{{ route('register') }}">Register</a>
            </div>
        @endauth
    </nav>

    <main class="container mt-4">
        @yield('content')
    </main>

</body>
</html>
