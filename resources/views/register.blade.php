@extends('layouts.app')

@push('styles')
    @vite(['resources/css/auth/register.css'])
@endpush

@section('content')
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
@endsection

@push('scripts')
    @vite(['resources/js/auth/register.js'])
@endpush
