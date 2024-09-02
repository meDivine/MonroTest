<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateSettingRequest;
use App\Services\ConfirmationService;
use Illuminate\Http\Request;
use App\Models\UserSettings;

class UserSettingController extends Controller
{
    protected $confirmationService;

    public function __construct(ConfirmationService $confirmationService)
    {
        $this->confirmationService = $confirmationService;
    }


    public function showUpdateForm()
    {
        return view('update');
    }

    /**
     * Создание токена для настройки с выбранным методом
     * @param \App\Http\Requests\UpdateSettingRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateSettingRequest $request)
    {
        $user = $request->user();
        $settingKey = $request->input('setting_key');
        $method = $request->input('method');

        // Генерация и отправка токена
        $this->confirmationService->createToken($user, $settingKey, $method);

        return redirect()->route('settings.confirm-form')
                         ->with('message', 'Код отправлен с помощью ' . $method);
    }

    /**
     * Вью для формы подтверждения
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showConfirmForm()
    {
        return view('settings.confirm');
    }


    public function confirm(Request $request)
    {
        $user = $request->user();
        $settingKey = $request->input('setting_key');
        $settingValue = $request->input('setting_value');
        $token = $request->input('token');

        if ($this->confirmationService->verifyToken($user, $settingKey, $token)) {
            // Обновление настройки после подтверждения
            UserSettings::updateOrCreate(
                ['user_id' => $user->id, 'setting_key' => $settingKey],
                ['setting_value' => $settingValue]
            );

            return redirect()->route('settings.update-form')
                             ->with('message', 'Настройка изменена');
        }

        return redirect()->route('settings.confirm-form')
                         ->withErrors(['token' => 'Токен устарел или неверен']);
    }
}

