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
                    <input name="name" type="text" value="{{ $data[0]->name ?? 'guest' }}" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 3px;">
                </div>
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px;">Email</label>
                    <input name="email" type="email" value="{{ $data[0]->email ?? 'guest' }}" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 3px;">
                </div>
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px;">Телефон</label>
                    <input type="tel" value="{{ $data[0]->phone ?? '' }}" name="phone" pattern="^(\+?\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{2}[\s-]?\d{2}$" title="Формат: +7 XXX XXX XX XX или 8XXX..." style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 3px;">
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
                @isset($data[1])
                    @foreach ($data[1] as $product)
                        <div class="cart-item">
                            <div>
                                <div class="product-title">{{ $product->name }}</div>
                                <div class="product-price">{{ $product->price }}</div>
                            </div>
                            <div>
                                <form method="GET" action="{{ route('delete_product_from_cart', $product->id) }}">
                                    <button class="btn btn-danger">Удалить</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
    
    
                    <div class="cart-total">
                        Итого: {{ $data[2]}} ₽
                    </div>

                    <form method="GET" action="{{ route('make_order') }}">
                        <button class="btn btn-primary" style="margin-top: 20px; width: 100%; padding: 12px;">Оформить заказ</button>
                    </form>
                        
                    
                @else
                    <a>зарегестрируйся</a>
                @endisset
                </div>
        </div>



        <div id="purchases" class="tab-content">
            <h2>История покупок</h2>
            <div id="purchased-items">
                @foreach ($data[3] as $product)
                    <div class="purchased-item">
                        <div>
                            <div class="product-title">{{ $product->name }}</div>
                            <div class="product-price">{{ $product->price }}</div>
                        </div>
                    </div>
                @endforeach

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
