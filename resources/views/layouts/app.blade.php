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
    

        @yield('content')


    @stack('scripts')
</body>
</html>