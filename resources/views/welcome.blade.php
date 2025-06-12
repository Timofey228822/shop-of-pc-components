<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добро пожаловать!</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }
        .welcome-container {
            margin-top: 100px;
        }
        h1 {
            color: #2c3e50;
        }
        .btn {
            display: inline-block;
            margin: 10px;
            padding: 12px 24px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #2980b9;
        }
        .btn-register {
            background-color: #2ecc71;
        }
        .btn-register:hover {
            background-color: #27ae60;
        }
    </style>
</head>
<body>
    <div class="welcome-container">
        <h1>Добро пожаловать!</h1>
        <p>Мы рады видеть вас на нашем сайте.</p>
        
        <div class="buttons">
            <a href="{{ route('register') }}" class="btn btn-register">Регистрация</a>
            <a href="/shop" class="btn">Магазин</a>
        </div>
    </div>
</body>
</html>