@extends('layouts.app')

@push('styles')
    @vite(['resources/css/for_shop/admin.css'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endpush

@section('content')
    @include('partials.sidebar')
    
    <div class="main-content">
        <div class="header">
            <h1>Дашборд</h1>
            <div>
                <span>Администратор</span>
                <i class="fas fa-user-circle" style="font-size: 24px; margin-left: 10px;"></i>
            </div>
        </div>
        

            <div class="stats">
                <div class="stat-card">
                    <h3>{{ $data[2] }}</h3>
                    <p>Всего заказов</p>
                </div>
                <div class="stat-card">
                    <h3>{{ $data[3] }}</h3>
                    <p>Общий доход</p>
                </div>
                <div class="stat-card">
                    <h3>{{ $data[1] }}</h3>
                    <p>Товаров</p>
                </div>
                <div class="stat-card">
                    <h3>{{ $data[0] }}</h3>
                    <p>Пользователей</p>
                </div>
            </div>
            
            <div class="card">
                <h2>Последние заказы в разработки, но вот шаблон</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Клиент</th>
                            <th>Покупка</th>
                            <th>Сумма</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data[4] as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ App\Models\User::where('id',$order->user_id)->first()->name }}</td>
                                <td>{{ App\Models\Product::where('id',$order->product_id)->first()->name }}</td>
                                <td>{{ App\Models\Product::where('id',$order->product_id)->first()->price }}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

    </div>
@endsection

@push('scripts')
    @vite(['resources/js/for_shop/admin.js'])
@endpush
