<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'User Settings')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <header>
            <h1>@yield('header', 'User Settings')</h1>
        </header>

        <main>
            @yield('content')
        </main>

        <footer>
            <p>&copy; {{ date('Y') }} Футер</p>
        </footer>
    </div>
</body>
</html>
