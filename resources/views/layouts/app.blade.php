<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Добро пожаловать в магаз')</title>
    
    @stack('styles')
</head>
<body>

    @yield('header', '')
    
    <main class="content">
        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>