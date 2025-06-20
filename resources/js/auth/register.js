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