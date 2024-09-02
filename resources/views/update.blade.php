@extends('app')

@section('title', 'Update Setting')

@section('content')
    <form action="{{ route('settings.update') }}" method="POST">
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
            <label for="setting_value">Новая настройка:</label>
            <input type="text" id="setting_value" name="setting_value" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="method">Подтверждение через:</label>
            <select id="method" name="method" class="form-control" required>
                <option value="sms">SMS</option>
                <option value="email">Email</option>
                <option value="telegram">Telegram</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Отправить</button>
    </form>
@endsection
