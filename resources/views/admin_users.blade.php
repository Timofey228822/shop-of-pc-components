@extends('layouts.app')

@push('styles')
    @vite(['resources/css/for_shop/admin.css'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endpush

@section('content')
    @include('partials.sidebar')

    <div class="main-content">


            <div class="card">
                <h2>Пользователи</h2>
                
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Имя</th>
                            <th>Email</th>
                            <th>Телефон</th>
                            <th>Регистрация</th>
                            <th>Действие</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td>
                                <form method="POST" action="{{ route('delete_user', $user->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-warning">удолить</button>
                                </form>
                                
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
    </div>
@endsection