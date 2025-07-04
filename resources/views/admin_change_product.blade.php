@extends('layouts.app')

@push('styles')
    @vite(['resources/css/auth/login.css'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endpush

@section('content')
    <form method="POST" action="{{ route('change_product', $product->id) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Название товара</label>
            <input 
                type="text" 
                id="name" 
                name="name" 
                required 
                value="{{ $product->name ?? '' }}"
                placeholder="видеокарта 3060 ti"
            >
        </div>
        <div class="form-group">
            <label>Описание</label>
            <input 
                type="text" 
                id="description" 
                name="description" 
                required 
                value="{{ $product->description ?? '' }}"
                placeholder="надо тиме"
            >
        </div>
        <div class="form-group">
            <label>Цена</label>
            <input 
                type="int" 
                id="price" 
                name="price" 
                required 
                placeholder="тиме нада мало"
                value="{{ $product->price ?? '' }}"
                autocomplete="current-password"
            >
        </div>
        <div class="form-group">
            <label>Категория</label>
            <select name="category" class="form-control" required>
                @foreach($categories as $category)
                <option value="{{ $category[0] }}">{{ $category[1] }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn-btn-submit" style="--primary-color: #4361ee">Обновить</button>
    </form>