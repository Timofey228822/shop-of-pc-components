@extends('layouts.app')

@push('styles')
    @vite(['resources/css/for_shop/admin.css'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endpush

@section('content')
    @include('partials.sidebar')

    <div class="main-content">


            <div class="card">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                    <h2>Товары</h2>
                    <form action="{{ route('add_product_page') }}" method="GET">
                        <button type="submit" class="btn btn-primary" id="addProductBtn">Добавить товар</button>
                    </form>
                </div>
                
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Изображение</th>
                            <th>Название</th>
                            <th>Категория</th>
                            <th>Цена</th>
                            <th>Остаток</th>
                            <th>Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td><img src="https://via.placeholder.com/50" alt="Product"></td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->categories->pluck('name')->implode(', ') }}</td>
                                <td>{{ $product->price }}</td>
                                <td>
                                    <form method="GET" action="/admin/changeProduct/productId={{ $product->id }}">
                                        <button class="btn btn-primary">Редактировать</button>
                                    </form>
                                    
                                    <form method="POST" action="{{ route('delete_product', $product->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger">Удалить</button>
                                    </form>
                                    
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

    </div>
@endsection
