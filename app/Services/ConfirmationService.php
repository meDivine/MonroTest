<?php

namespace App\Services;

use App\Models\ConfirmationTokens;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ConfirmationService
{
    /**
     * Создание токена
     * @param mixed $user
     * @param mixed $settingKey
     * @param mixed $method
     * @return ConfirmationTokens|\Illuminate\Database\Eloquent\Model
     */
    public function createToken($user, $settingKey, $method)
    {
        //Сгенерируем случайную строку с токеном
        $token = Str::random(6);

        /*
         * Запишем токен в бд. Юзера можно было брать и из сессии
         * Но добавлена вариативность
         * Пример: отправка токена из админки
         */
        return ConfirmationTokens::create([
            'user_id' => $user->id,
            'setting_key' => $settingKey,
            'token' => Hash::make($token),
            'method' => $method,
            'expires_at' => Carbon::now()->addMinutes(10), // Время жизни токена 10 минут
        ]);
    }
    /**
     * Подтверждение токена
     * @param mixed $user
     * @param mixed $settingKey
     * @param mixed $token
     * @return bool
     */
    public function verifyToken($user, $settingKey, $token)
    {
        /*
         * Получим токен по выбранному нами сервису
         */
        $confirmationToken = ConfirmationTokens::where('user_id', $user->id)
            ->where('setting_key', $settingKey)
            ->where('is_confirmed', false)
            ->where('expires_at', '>', Carbon::now())
            ->first();

        /*
         * Проверим хэш токена с введенным нами токеном, вернем тру если проверка пройдена
        */
        if ($confirmationToken && Hash::check($token, $confirmationToken->token)) {
            $confirmationToken->is_confirmed = true;
            $confirmationToken->save();

            return true;
        }

        return false;
    }
}
