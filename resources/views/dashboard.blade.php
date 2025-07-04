@extends('layouts.app')


@push('styles')
    @vite(['resources/css/for_shop/dashboard.css'])
@endpush

@section('header')
    @include('partials.header')
@endsection

@section('content')

    <div class="container">
        <div class="tabs">
            <div class="tab active" data-tab="profile">Профиль</div>
            <div class="tab" data-tab="cart">Корзина</div>
            <div class="tab" data-tab="purchases">Мои покупки</div>
            <div class="tab" data-tab="shop">Магаз</div>
        </div>

        <div id="profile" class="tab-content active">
            <h2>Личные данные</h2>
            <form method="POST" action="{{ route('update') }}">
                @csrf
                @method('PUT')
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px;">ФИО</label>
                    <input name="name" type="text" value="{{ $data->name ?? 'guest' }}" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 3px;">
                </div>
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px;">Email</label>
                    <input name="email" type="email" value="{{ $data->email ?? 'guest' }}" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 3px;">
                </div>
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px;">Телефон</label>
                    <input type="tel" value="{{ $data->phone ?? '' }}" name="phone" pattern="^(\+?\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{2}[\s-]?\d{2}$" title="Формат: +7 XXX XXX XX XX или 8XXX..." style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 3px;">
                </div>
                <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                
            </form>
            
            <form method="GET" action="{{ route('exit') }}">
                <button type="submit" class="btn btn-primary">Выйти из Аккаунта</button>
            </form>
        </div>

        <div id="cart" class="tab-content">
            <h2>Корзина</h2>
            <div id="cart-items">
                <div class="cart-item">
                    <div>
                        <div class="product-title">Смартфон XYZ Pro</div>
                        <div class="product-price">32 990 ₽</div>
                    </div>
                    <div>
                        <button class="btn btn-danger">Удалить</button>
                    </div>
                </div>
                <div class="cart-item">
                    <div>
                        <div class="product-title">Наушники Premium Sound</div>
                        <div class="product-price">7 490 ₽</div>
                    </div>
                    <div>
                        <button class="btn btn-danger">Удалить</button>
                    </div>
                </div>
                <div class="cart-total">
                    Итого: 40 480 ₽
                </div>
            </div>
            <button class="btn btn-primary" style="margin-top: 20px; width: 100%; padding: 12px;">Оформить заказ</button>
        </div>

        <div id="purchases" class="tab-content">
            <h2>История покупок</h2>
            <div id="purchased-items">
                <div class="purchased-item">
                    <div>
                        <div class="product-title">Ноутбук UltraBook 15</div>
                        <div>Количество: 1</div>
                        <div class="product-price">64 990 ₽</div>
                    </div>
                    <div class="purchase-date">
                        15.05.2023
                    </div>
                </div>
                <div class="purchased-item">
                    <div>
                        <div class="product-title">Беспроводная мышь</div>
                        <div>Количество: 2</div>
                        <div class="product-price">1 990 ₽ (за шт)</div>
                    </div>
                    <div class="purchase-date">
                        02.04.2023
                    </div>
                </div>
                <div class="purchased-item">
                    <div>
                        <div class="product-title">Чехол для смартфона</div>
                        <div>Количество: 1</div>
                        <div class="product-price">890 ₽</div>
                    </div>
                    <div class="purchase-date">
                        12.03.2023
                    </div>
                </div>
            </div>
        </div>
        <div id="shop" class="tab-content">
            <form method="GET" action="{{ route('shop') }}">
                <button type="submit" class="btn btn-primary">Перейти в магаз</button>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
    @vite(['resources/js/for_shop/dashboard.js'])
@endpush
