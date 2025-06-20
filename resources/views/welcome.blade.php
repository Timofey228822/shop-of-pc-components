@extends('layouts.app')

@push('styles')
    @vite(['resources/css/auth/welcome.css'])
@endpush

@section('content')
    <div class="welcome-container">
        <h1>Добро пожаловать!</h1>
        <p>Мы рады видеть вас на нашем сайте.</p>
        
        <div class="buttons">
            <a href="{{ route('register') }}" class="btn btn-register">Регистрация</a>
            <a href="/shop" class="btn">Магазин</a>
        </div>
    </div>
@endsection