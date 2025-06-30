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
                    <h3>в разработке</h3>
                    <p>Всего заказов</p>
                </div>
                <div class="stat-card">
                    <h3>в разработке</h3>
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
                            <th>Дата</th>
                            <th>Сумма</th>
                            <th>Статус</th>
                            <th>Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#1245</td>
                            <td>Иван Иванов</td>
                            <td>12.05.2023</td>
                            <td>₽2,450</td>
                            <td><span style="color: var(--success)">Завершен</span></td>
                            <td>
                                <button class="btn btn-primary">Просмотр</button>
                            </td>
                        </tr>
                        <tr>
                            <td>#1244</td>
                            <td>Петр Петров</td>
                            <td>11.05.2023</td>
                            <td>₽1,780</td>
                            <td><span style="color: var(--warning)">В обработке</span></td>
                            <td>
                                <button class="btn btn-primary">Просмотр</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
    </div>
@endsection

@push('scripts')
    @vite(['resources/js/for_shop/admin.js'])
@endpush
