<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hamcrest\Core\Set;
use Illuminate\Http\Request;
use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Cartalyst\Sentinel\Laravel\Facades\Reminder;
use App\Http\Requests;
use Validator;
use App\Models\UserData;
use App\Models\Setting;
use Mail;
use Carbon\Carbon;
use App\Http\Controllers\CartController;

class LoginController extends Controller
{
    /**
     * Авторизация пользователей, проверка ролей
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
//    public function login()
//    {
//        if (Sentinel::check()) {
//            $user_id = Sentinel::check()->id;
//            if (Sentinel::inRole('admin') or Sentinel::inRole('manager')) {
//                return redirect('/admin');
//            } elseif (Sentinel::inRole('user')) {
//                return redirect('/user');
//            }
//        } else {
//            return view('login');
//        }
//    }

    /**
     * Аутентификация пользователей
     *
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function authenticate(Request $request)
    {

        $rules = [
            'email'     =>'required|email',
            'password'  => 'required',
        ];

        $messages = [
            'email.required'    => 'Введите email-адрес!',
            'email.email'       => 'Некорректный email-адрес!',
            'password.required' => 'Введите свой пароль!',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
//            return redirect('/login')
//                ->withInput()
//                ->withErrors($validator);
            return response()->json(['error' => $validator->messages()]);
        }

        $credentials = [
            'email'    => $request->get('email'),
            'password' => $request->get('password'),
        ];

        $user = Sentinel::findByCredentials($credentials);

        if(!$user){
//            if ($request->action == 'checkout'){
//                return redirect('/checkout#login')
//                    ->withErrors(['email' => 'Пользователь с таким email-адресом не зарегистрирован!'])
//                    ->withInput($request->except('password'));
//            } else {
//                return redirect('/login')
//                    ->withErrors(['email' => 'Пользователь с таким email-адресом не зарегистрирован!'])
//                    ->withInput($request->except('password'));
//            }
            return response()->json(['error' => ['email' => ['Пользователь с таким email-адресом не зарегистрирован!']]]);
        }

        $auth = Sentinel::authenticateAndRemember($credentials);

        if(!$auth){
//            if ($request->action == 'checkout'){
//                return redirect('/checkout#login')
//                    ->withErrors(['password' => 'Неверный пароль!'])
//                    ->withInput($request->except('password'));
//            } else {
//                return redirect('/login')
//                    ->withErrors(['password' => 'Неверный пароль!'])
//                    ->withInput($request->except('password'));
//            }

            return response()->json(['error' => ['password' => ['Неверный пароль!']]]);
        }

        CartController::cartToUser($user->id);
        if($request->action == 'checkout'){
            //return redirect('/checkout');
            return response()->json(['success' => true, 'redirect' => '/checkout']);
        }

        //return redirect ('/login');
        if (Sentinel::check()) {
            if (Sentinel::inRole('admin') or Sentinel::inRole('manager')) {
                return response()->json(['success' => true, 'redirect' => '/admin']);
            } elseif (Sentinel::inRole('user')) {
                return response()->json(['success' => true, 'redirect' => '/user']);
            }
        }
    }

    /**
     * Подключение темплейта регистрации
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
//    public function register()
//    {
//        if (Sentinel::check()) {
//            return redirect('/user');
//        } else {
//            return view('register');
//        }
//    }

    /**
     * Регистрация пользователей, сохранение в БД
     *
     * @param Request $request
     * @param UserData $user_data
     * @return $this|\Illuminate\Http\RedirectResponse|string
     */
    public function store(Request $request, UserData $user_data, Setting $settings) {

        $rules = [
            'first_name' => 'required',
            'phone'     => 'required|regex:/^[0-9\-! ,\'\"\/+@\.:\(\)]+$/',
            'email'     =>'required|email',
            'password'  => 'required|min:6',
            'password_confirmation' => 'required|min:6|same:password',
        ];

        $messages = [
            'first_name.required' => 'Не заполнено имя!',
            'phone.required'    => 'Не заполнен телефон!',
            'phone.regex'       => 'Некорректный телефон!',
            'email.required'    => 'Не заполнен email!',
            'email.email'       => 'Некорректный email-адрес!',
            'password.required' => 'Не заполнен пароль!',
            'password.min'      => 'Пароль должен быть не менее 6 символов!',
            'password_confirmation.min'      => 'Пароль должен быть не менее 6 символов!',
            'password_confirmation.same' => 'Введенные пароли не совпадают!',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
//            return redirect()
//                ->back()
//                ->withInput()
//                ->withErrors($validator);
            return response()->json(['error' => $validator->messages()]);
        }

        $user_exists = User::where('email', $request->email)->first();

        if ($user_exists){
            $user = Sentinel::findById($user_exists->id);
            if($user->inRole('unregister_user')){

                $credentials = [
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'password' => $request->password,
                    'phone'   => $request->phone,
                    'permissions' => [
                        'user' => true
                    ]
                ];

                Sentinel::update($user, $credentials);

                $role = Sentinel::findRoleBySlug('unregister_user');
                $role->users()->detach($user);

                $userRole = Sentinel::findRoleBySlug('user');
                $userRole->users()->attach($user);

                $credentials['email'] = $request->email;

                $auth = Sentinel::authenticateAndRemember($credentials);
                $user_id = $user_exists->id;
                if($auth){

                    Mail::send('emails.register', ['user' => $credentials], function($msg) use ($request, $settings){
                        $msg->from($settings->get_setting('site_email'), 'Интернет-магазин ВерхАгро');
                        $msg->to($request->email);
                        $msg->subject('Регистрация в интернет-магазине');
                    });

                    CartController::cartToUser($user_id);

                    if(!isset($request->checkout_registration)){
//                        return redirect('/user')
//                            ->with('status', 'Вы успешно зарегистрированы! Добро пожаловать в личный кабинет');
                        return response()->json(['success' => true, 'redirect' => '/user']);
                    } elseif (isset($request->checkout_registration)) {
                        $response = 'success';
                        return $response;
                    }

                } else {
                    if(!isset($request->checkout_registration)){
//                        return redirect()
//                            ->back()
//                            ->withInput()
//                            ->withErrors(['error' => 'При регистрации произошла ошибка!']);
                        return response()->json(['error' => ['err' => ['При регистрации произошла ошибка!']]]);
                    } elseif (isset($request->checkout_registration)) {
                        $response = 'error';
                        return $response;
                    }

                }

            } else {
                if (!isset($request->checkout_registration)) {
//                    return redirect()
//                        ->back()
//                        ->withInput()
//                        ->withErrors(['email' => 'Пользователь с таким email-ом уже зарегистрирован!']);
                    return response()->json(['error' => ['err' => ['Пользователь с таким email-ом уже зарегистрирован!']]]);
                } elseif (isset($request->checkout_registration)) {
                    $response = 'email error';
                    return $response;
                }
            }
        }

        $credentials = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone'     => $request->phone,
            'email'     => $request->email,
            'password'  => $request->password,
            'permissions' => [
                'user' => true
            ]
        ];

        $user = Sentinel::registerAndActivate($credentials);
        $user = User::find($user->id);
        $user->fill(['phone' => $request->phone]);
        $user->save();

        Mail::send('emails.register', ['user' => $credentials], function($msg) use ($request, $settings){
            $msg->from($settings->get_setting('site_email'), 'Интернет-магазин ВерхАгро');
            $msg->to($request->email);
            $msg->subject('Регистрация в интернет-магазине');
        });

        $userRole = Sentinel::findRoleBySlug('user');
        $userRole->users()->attach($user);

        CartController::cartToUser($user->id);

        $user_data->create([
            'user_id'   => $user->id,
            'image_id'  => 1,
            'subscribe' => 0
        ]);

        $auth = Sentinel::authenticateAndRemember($credentials);

        if($auth && !isset($request->checkout_registration)){
//            return redirect('/user')
//                ->with('status', 'Вы успешно зарегистрированы! Добро пожаловать в личный кабинет');
            return response()->json(['success' => true, 'redirect' => '/user']);
        } elseif ($auth && isset($request->checkout_registration)) {
            $response = 'success';
            return $response;
        } elseif(!$auth && !isset($request->checkout_registration)) {
//            return redirect()
//                ->back()
//                ->withInput()
//                ->withErrors(['error' => 'При регистрации произошла ошибка! Повторите попытку позже.']);
            return response()->json(['error' => ['err' => ['При регистрации произошла ошибка! Повторите попытку позже.']]]);
        } elseif(!$auth && isset($request->checkout_registration)) {
            $response = 'error';
            return $response;
        }

    }

    /**
     * Сохранение пользователей в БД как незарегистрированных
     *
     * @param Request $request
     * @return int
     */
    public function storeAsUnregistered(Request $request)
    {
        $credentials = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone'     => $request->phone,
            'email'     => $request->email,
            'password'  => 'null',
            'permissions' => [
                'unregistered' => true
            ]
        ];

        $user = Sentinel::registerAndActivate($credentials);

        $userRole = Sentinel::findRoleBySlug('unregister_user');
        $userRole->users()->attach($user);

        if ($user->id) {
            CartController::cartToUser($user->id);

            $user_data = UserData::create([
                'user_id'   => $user->id,
                'image_id'  => 1,
                'subscribe' => 0
            ]);

            $response = $user;
        } else {
            $response = 0;
        }

        return $response;
    }

    /**
     * Подключение темплейта восстановления пароля
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function forgotten()
    {
        return view('users.forgotten');
    }

    /**
     * Процесс восстановления пароля, отправка пользователю сообщения на почту с кодом восстановления
     *
     * @param Request $request
     * @param Mail $mail
     * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function reminder(Request $request, Mail $mail, Setting $settings)
    {
        $rules = [
            'email'     =>'required|email',
        ];

        $messages = [
            'email.required'    => 'Введите email-адрес!',
            'email.email'       => 'Некорректный email-адрес!',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
        }

        $user_exists = User::where('email', $request->email)->first();

        if ($user_exists) {
            $user = Sentinel::findById($user_exists->id);

            ($reminder = Reminder::exists($user)) || ($reminder = Reminder::create($user));

            Mail::send('emails.reminder', ['user' => $user, 'reminder' => $reminder], function($msg) use ($user, $request, $settings){
                $msg->from($settings->get_setting('site_email'), 'Интернет-магазин ВкрхАгро');
                $msg->to($request->email);
                $msg->subject('Восстановление пароля');
            });

            return view('users.forgotten_email_sent');
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['email' => 'Пользователь с таким email-адресом не зарегистрирован!']);
        }

    }

    /**
     * Подключение темплейта смены пароля
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function lostpassword(Request $request)
    {
        if($request->id && $request->code){
            $user = Sentinel::findById($request->id);

            if (Reminder::exists($user, $request->code)) {
                return view('users.lostpassword');
            }
        } else {
            return redirect('/');
        }
    }

    /**
     * Смена пароля
     *
     * @param Request $request
     * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function changePassword(Request $request)
    {
        $rules = [
            'password'  => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
        ];

        $messages = [
            'password.required' => 'Введите новый пароль!',
            'password.min'      => 'Пароль должен быть не менее 6 символов!',
            'password.confirmed' => 'Введенные пароли не совпадают!',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator);
        }

        $user = Sentinel::findById($request->id);
        Reminder::complete($user, $request->code, $request->password);

        return view('users.lostpassword_complete');
    }

    /**
     * Выход из личного кабинета
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Sentinel::logout();
        return redirect()->back();
    }
}
