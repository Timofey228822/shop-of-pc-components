<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }
        
        .registration-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            padding: 40px;
        }
        
        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
            font-size: 28px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: 500;
        }
        
        input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            transition: border-color 0.3s;
        }
        
        input:focus {
            border-color: #4a90e2;
            outline: none;
            box-shadow: 0 0 0 2px rgba(74, 144, 226, 0.2);
        }
        
        .error-message {
            color: #e74c3c;
            font-size: 14px;
            margin-top: 5px;
            display: none;
        }
        
        button {
            width: 100%;
            padding: 14px;
            background-color: #4a90e2;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 10px;
        }
        
        button:hover {
            background-color: #3a7bc8;
        }
        
        .login-link {
            text-align: center;
            margin-top: 20px;
            color: #666;
        }
        
        .login-link a {
            color: #4a90e2;
            text-decoration: none;
        }
        
        .login-link a:hover {
            text-decoration: underline;
        }
        
        .password-strength {
            height: 5px;
            background-color: #eee;
            border-radius: 5px;
            margin-top: 5px;
            overflow: hidden;
        }
        
        .strength-bar {
            height: 100%;
            width: 0;
            background-color: #e74c3c;
            transition: width 0.3s, background-color 0.3s;
        }
    </style>
</head>
<body>
    <div class="registration-container">
        <h1>Создать аккаунт</h1>
        <h1>{{ $check['no'] ?? '' }}</h1>
        <form method="POST" action="{{ route('create') }}" id="registrationForm">
            @csrf
            <div class="form-group">
                
                <label for="name">Имя</label>
                <input type="text" id="name" name="name" required>
                <div class="error-message" id="name-error">Пожалуйста, введите ваше имя</div>
            </div>
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
                <div class="error-message" id="email-error">Пожалуйста, введите корректный email</div>
            </div>
            
            <div class="form-group">
                <label for="password">Пароль</label>
                <input type="password" id="password" name="password" required minlength="6">
                <div class="password-strength">
                    <div class="strength-bar" id="password-strength-bar"></div>
                </div>
                <div class="error-message" id="password-error">Пароль должен содержать минимум 6 символов</div>
            </div>
            
            <div class="form-group">
                <label for="confirm-password">Подтвердите пароль</label>
                <input type="password" id="confirm-password" name="confirm-password" required>
                <div class="error-message" id="confirm-password-error">Пароли не совпадают</div>
            </div>
            
            <button type="submit" >Зарегистрироваться</button>
        </form>
        
        <div class="login-link">
            Уже есть аккаунт? <a href="{{ 'login' }}">Войти</a>
        </div>
    </div>

    <script>

        document.getElementById('registrationForm').addEventListener('submit', function(e) {
        // Сброс ошибок
        document.querySelectorAll('.error-message').forEach(el => el.style.display = 'none');
        
        // Валидация
        let isValid = true;
        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirm-password').value;
        
        if (!name) {
            document.getElementById('name-error').style.display = 'block';
            isValid = false;
        }
        
        if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            document.getElementById('email-error').style.display = 'block';
            isValid = false;
        }
        
        if (password.length < 6) {
            document.getElementById('password-error').style.display = 'block';
            isValid = false;
        }
        
        if (password !== confirmPassword) {
            document.getElementById('confirm-password-error').style.display = 'block';
            isValid = false;
        }
        
        if (!isValid) {
            e.preventDefault(); // Только если валидация не прошла
        }
        // Если валидация прошла - форма отправится автоматически
    });
</script>
</body>
</html>