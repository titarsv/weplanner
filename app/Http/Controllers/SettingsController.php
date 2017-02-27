<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cartalyst\Sentinel\Native\Facades\Sentinel;
use App\Http\Requests;
use App\Models\Setting;
use Validator;

class SettingsController extends Controller
{

    public function index(Setting $setting)
    {
        return view('admin.settings', [
                'settings' => $setting->get_all()
            ]);
    }

    public function update(Request $request, Setting $settings)
    {
        $rules = [
            'meta_title' => 'required|max:75',
            'meta_description' => 'max:180',
            'meta_keywords' => 'max:180',
            'notify_emails.*' => 'email|distinct|filled',
            'phone_1' => 'regex:/^[0-9\-! ,\'\"\/+@\.:\(\)]+$/',
            'phone_2' => 'regex:/^[0-9\-! ,\'\"\/+@\.:\(\)]+$/',
        ];

        $messages = [
            'meta_title.required' => 'Поле должно быть заполнено!',
            'meta_title.max' => 'Максимальная длина заголовка не может превышать 75 символов!',
            'meta_description.max' => 'Максимальная длина описания не может превышать 180 символов!',
            'meta_keywords.max' => 'Максимальная длина ключевых слов не может превышать 180 символов!',
            'notify_emails.*.email' => 'Введите корректный e-mail адрес!',
            'notify_emails.*.distinct' => 'Значения одинаковы!',
            'notify_emails.*.filled' => 'Поле должно быть заполнено!',
            'phone_1.regex' => 'Неверный формат телефона!',
            'phone_2.regex' => 'Неверный формат телефона!',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->with('message-error', 'Сохранение не удалось! Проверьте форму на ошибки!')
                ->withErrors($validator);
        }

        $branches = [];

        foreach ($request->city as $key => $city){
            if(!empty($request->branch_address[$key]) && !empty($request->phones[$key]))
                $branches[] = ['city' => $city, 'address' => $request->branch_address[$key], 'phones' => explode(',', $request->phones[$key])];
        }

        $settings->update_setting('branches', $branches, true);

        $settings->update_settings($request->except(['_token', 'phones', 'city', 'branch_address']), true);

        return back()->with('message-success', 'Настройки успешно сохранены!');
    }

}
