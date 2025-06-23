@extends('layouts.app')

@push('styles')
    @vite(['resources/css/auth/login.css'])
@endpush

@section('content')
    <div class="login-container">
        <div class="login-header">
            <h2>Добро пожаловать</h2>
            <p>Введите свои данные для входа</p>
        </div>
        <form method="POST" action="{{ route('auth') }}">
            @csrf
            <div class="form-group">
                <label for="email">Электронная почта</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    required 
                    placeholder="example@mail.com"

                >
            </div>

            <div class="form-group">
                <label for="name">Имя пользователя</label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    required 
                    placeholder="Ваш логин"

                >
            </div>

            <div class="form-group">
                <label for="password">Пароль</label>
                <div class="password-container">
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        required 
                        placeholder="Не менее 8 символов"
                        autocomplete="current-password"
                    >
                    <span class="toggle-password">👁️</span>
                </div>
            </div>

            <button type="submit" class="btn-login" style="--primary-color: #4361ee">Войти</button>
        </form>

        <div class="login-footer">
            <p>Нет аккаунта? <a href="/register">Зарегистрироваться</a></p>
            <p><a href="/forgot-password">Забыли пароль?</a></p>
        </div>
    </div>
@endsection

@push('scripts')
    @vite(['resources/js/auth/login.js'])
@endpush