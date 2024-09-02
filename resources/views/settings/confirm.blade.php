@extends('app')

@section('title', 'Confirm Setting Change')

@section('content')
    <form action="{{ route('settings.confirm') }}" method="POST">
        @csrf
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <div class="form-group">
            <label for="setting_key">Настройка:</label>
            <input type="text" id="setting_key" name="setting_key" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="token">Код подтверждения:</label>
            <input type="text" id="token" name="token" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="setting_value">Новое значение настройки:</label>
            <input type="text" id="setting_value" name="setting_value" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Отправить</button>
    </form>
@endsection
