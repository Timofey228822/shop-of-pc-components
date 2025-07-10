@extends('layouts.app')

@push('styles')
    @vite(['resources/css/for_shop/shop.css'])
@endpush

@section('content')
    <div class="container">
        <!-- Сайдбар с категориями -->
        <div class="sidebar">
            <div class="logo">DarkShop</div>
        

            <div class="categories">
                <h3>Категории</h3>
                <ul>
                    @foreach ($categories as $category)
                        <li><a href="/shop/category_id={{ $category['id'] }}">{{ $category['name'] }}</a></li>
                    @endforeach
                </ul>
            </div>
            
            <div class="user-panel">
                <a href="{{ route('dashboard') }}">Личный кабинет</a>
            </div>
            <div class="user-panel">
                <a href="{{ route('shop') }}">На главную</a>
            </div>

        </div>
        
        <!-- Основное содержимое -->
        <div class="main-content">
            <div class="header">
                <div class="cart-icon">
                    🛒
                    <span class="cart-count">3</span>
                </div>

                <a>пж дайте денег</a>
            </div>
            
            <div class="products-grid">
                @foreach ($products as $product)
                <a href="/product/productName={{ $product['name'] }}">
                    <div class="product-card">
                        <div class="product-image">
                            <img src="{{ asset('storage/'.$product->image()->first()->path)}}">
                        </div>
                        <div class="product-info">
                            <h3 class="product-title">{{ $product['name'] }}</h3>
                            <div class="product-price">{{ $product['price'] }}₽</div>
                            <div class="product-actions">
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection