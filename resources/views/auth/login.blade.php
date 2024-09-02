@extends('app')

@section('title', 'Login')

@section('content')
    <div class="login-container">
        <h2>Авторизация</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">Почта:</label>
                <input type="email" id="email" name="email" class="form-control" required autofocus>
            </div>

            <div class="form-group">
                <label for="password">Пароль:</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>

            <div class="form-group form-check">
                <input type="checkbox" id="remember" name="remember" class="form-check-input">
                <label for="remember" class="form-check-label">Запомнить меня</label>
            </div>

            <button type="submit" class="btn btn-primary">Войти</button>
        </form>
    </div>
@endsection
