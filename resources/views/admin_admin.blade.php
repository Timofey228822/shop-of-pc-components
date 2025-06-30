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
                    <h2>Администраторы</h2>
                    <form method="GET" action="{{ route('add_admin_page') }}">
                        <button class="btn btn-primary" id="addAdminBtn">Добавить администратора</button>
                    </form>
                    
                </div>
                
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Имя</th>
                            <th>Email</th>
                            <th>Роль</th>
                            <th>Дата назначения</th>
                            <th>Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $admin)
                        <tr>
                            <td>{{ $admin->id }}</td>
                            <td>{{ $admin->name }}</td>
                            <td>{{ $admin->email }}</td>
                            <td>{{ $admin->role }}</td>
                            <td>{{ $admin->updated_at }}</td>
                            <td>
                                <form method="GET" action="{{ route('change_to_user', $admin->id) }}">
                                    <button class="btn btn-danger">Сделать пользователем</button>
                                </form>
                                
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

    </div>
@endsection