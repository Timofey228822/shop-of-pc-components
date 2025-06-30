@extends('layouts.app')

@push('styles')
    @vite(['resources/css/auth/login.css'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endpush

@section('content')
    <form method="POST" action="{{ route('add_admin') }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Имя пользователя</label>
            <input 
                type="text" 
                id="name" 
                name="name" 
                required 
            >
        </div>
        <div class="form-group">
            <label>Его почта</label>
            <input 
                type="email" 
                id="email" 
                name="email" 
                required 
            >
        </div>
        <button type="submit" class="btn-btn-submit" style="--primary-color: #4361ee">Добавить</button>
    </form>