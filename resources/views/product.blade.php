@extends('layouts.app')

@push('styles')
    @vite(['resources/css/for_shop/product.css'])
@endpush

@section('content')
    <div class="product-page">
        <div class="product-header">
            <div class="product-gallery">
                <img src="{{ asset('storage/'.$product->image()->where('type', 'main')->first()->path) }}" alt="Основное изображение товара" class="main-image">
            </div>
            
            <div class="product-info">
                <h1 class="product-title">{{ $product->name }}</h1>
                <div class="product-price">{{ $product->price }}₽</div>
                
                <div class="product-rating">
                </div>

                <form method="GET" action="{{ route('add_to_cart', $product->id) }}">
                    <button class="add-to-cart">Добавить в корзину</button>
                </form>

                <form method="GET" action="{{ route('shop') }}">
                    <button type="submit" class="back-to-shop">Обратно</button>
                </form>
                
                <div class="product-description">
                    <p>{{ $product->description }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection