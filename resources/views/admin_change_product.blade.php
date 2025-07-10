@extends('layouts.app')

@push('styles')
    @vite(['resources/css/auth/login.css'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endpush

@section('content')
    <form method="POST" action="{{ route('change_product', $product->id) }}" enctype="multipart/form-data">
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
            <select name="category_id" class="form-control" required>
                @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <input type="file" name="image">

        <button type="submit" class="btn-btn-submit" style="--primary-color: #4361ee">Обновить</button>
    </form>