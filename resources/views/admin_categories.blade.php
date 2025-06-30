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
                    <h2>Категории</h2>
                    <form method="GET" action="{{ route('add_category_page') }}">
                        <button class="btn btn-primary" id="addCategoryBtn">Добавить Категорию</button>
                    </form>
                    
                </div>
                
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Название</th>
                            <th>Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $category)
                            <tr>
                                <td>{{ $category[0] }}</td>
                                <td>{{ $category[1] }}</td>
                                <td>
                                    <form method="GET" action="{{ route('update_category_page', $category[0]) }}">
                                        <button class="btn btn-primary">Редактировать</button>
                                    </form>
                                    
                                    <form method="GET" action="{{ route('delete_category', $category[0]) }}">
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