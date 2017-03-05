<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Cartalyst\Sentinel\Native\Facades\Sentinel;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Validator;

use App\Models\User;
use App\Models\Setting;
use App\Models\Image;
use App\Models\UserData;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\ProductsInOrder;
use App\Models\Wishlist;
use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;
use App\Models\ProductsCart;
use Breadcrumbs;

use Cartalyst\Sentinel\Roles\EloquentRole as Roles;

class UserController extends Controller
{

    /**
     * Список всех зарегистрированных и незарегистрированных пользователей
     * в панели администратора
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::join('role_users', function ($join) {
                $join->on('users.id', '=', 'role_users.user_id')
                    ->whereIn('role_users.role_id', [3,4]);
                })
                ->paginate(8);

        return view('admin.users.index', [
            'users' => $users,
            'title' => 'Список пользователей'
        ]);
    }

    /**
    * Отображение формы редактирования пользователя
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        return view('admin.users.edit', [
            'user'      => User::find($id),
            'user_data' => UserData::where('user_id', $id)->first()
        ]);
    }

    /**
     * Редактирование пользователя
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $rules = [
            'first_name' => 'required',
            'phone'     => 'required|regex:/^[0-9\-! ,\'\"\/+@\.:\(\)]+$/',
            'email'     => 'required|email|unique:users,email,'.$id,
        ];

        $messages = [
            'first_name.required' => 'Не заполнены обязательные поля!',
            'phone.required'    => 'Не заполнены обязательные поля!',
            'phone.regex'       => 'Некорректный телефон!',
            'email.required'    => 'Не заполнены обязательные поля!',
            'email.email'       => 'Некорректный email-адрес!',
            'email.unique'      => 'Пользователь с таким email-ом уже зарегистрирован!'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        $user = User::find($id);
        $user_data = UserData::where('user_id', $id)->first();

        if($validator->fails()){
            return redirect()
                ->back()
                ->withInput()
                ->with('message-error', 'Сохранение не удалось! Проверьте форму на ошибки!')
                ->withErrors($validator);
        }

        $request_user = $request->only(['first_name', 'last_name', 'email', 'phone']);
        $user->fill($request_user);
        $user->save();

        $request_user_data = $request->only(['user_id', 'address', 'company']);

        $user_data->update($request_user_data);

        $user_role = Sentinel::findRoleBySlug('user');
        $unreg_user_role = Sentinel::findRoleBySlug('unregister_user');
        $unreg_users = $unreg_user_role->users()->with('roles')->get();
        $users = $user_role->users()->with('roles')->get();
        $users = $users->merge($unreg_users);

        return redirect('/admin/users')
            ->with('users', $users)
            ->with('message-success', 'Пользователь ' . $user->first_name . ' ' . $user->last_name . ' успешно обновлен.');
    }

    /**
     * Отображение личного кабинета пользователя
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user = Sentinel::check();
        $user = User::find($user->id);
        $orders = Order::where('user_id',$user->id)->orderBy('created_at','desc')->get();

        foreach ($orders as $order) {
            $order->date = $order->updated_at->format('d.m.Y');
            $order->time = $order->updated_at->format('H:i');
        }

        return view('public.account', [
            'user' => $user,
            'orders' => $orders
        ]);
    }

    /**
     * Сохранение отредактированных личных данных в БД
     *
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function saveChangedData(Request $request)
    {
        $user = Sentinel::check();

        if ($user) {
            $user = User::find($user->id);
        }

        $rules = [
            'first_name' => 'required',
            'phone'     => 'required|regex:/^[0-9\-! ,\'\"\/+@\.:\(\)]+$/',
            'email'     => 'required|email|unique:users,email,'.$user->id,
            'password'  => 'min:6|confirmed',
            'password_confirmation' => 'min:6',
        ];

        $messages = [
            'first_name.required' => 'Не заполнены обязательные поля!',
            'phone.required'    => 'Не заполнены обязательные поля!',
            'phone.regex'       => 'Некорректный телефон!',
            'email.required'    => 'Не заполнены обязательные поля!',
            'email.email'       => 'Некорректный email-адрес!',
            'email.unique'      => 'Пользователь с таким email-ом уже зарегистрирован!',
            'password.min'      => 'Пароль должен быть не менее 6 символов!',
            'password.confirmed' => 'Введенные пароли не совпадают!',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        $user->first_name = htmlspecialchars($request->first_name);
        $user->last_name = htmlspecialchars($request->last_name);
        $user->patronymic = htmlspecialchars($request->patronymic);
        $user->email = htmlspecialchars($request->email);
        $user->phone = htmlspecialchars($request->phone);
        $user->user_data->address = json_encode([
            'city'  => $request->city ? $request->city : '',
            'address' => $request->address ? $request->address : ''
        ]);
        $user->user_data->subscribe = $request->subscribe ? 1 : 0;

        if($request->password) {
            $user->password = password_hash($request->password, PASSWORD_DEFAULT);
        }

        $user->push();

        return redirect('/user');

        //return response()->json(['success' => $request->except(['_token', 'password', 'password_confirmation'])], 200);
    }

    /**
     * Оформление подписки на новости
     *
     * @param Request $request
     * @param User $user
     * @param UserData $user_data
     * @return \Illuminate\Http\JsonResponse
     */
    public function subscribe(Request $request, User $user, UserData $user_data)
    {
        $rules = [
            'email'     => 'required|email'
        ];

        $messages = [
            'email.required'    => 'Вы не указали email-адрес!',
            'email.email'       => 'Некорректный email-адрес!',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }

        $user_exists = User::where('email', $request->email)->first();

        if ($user_exists){
            $subscribe = $user->where('id', $user_exists->id)->first();
            $subscribe->user_data->subscribe = 1;
            $subscribe->save();
        } else {
            $user = Sentinel::registerAndActivate(array(
                'email'    => $request->email,
                'password' => 'null',
                'permissions' => [
                    'unregistered' => true
            ]
            ));

            $role = Sentinel::findRoleBySlug('unregister_user');
            $role->users()->attach($user);

            $user_data->create([
                'user_id'   => $user->id,
                'image_id'  => 1,
                'subscribe' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }

        return response()->json(['success' => 'Вы успешно подписались на новости!']);
    }

    /**
     * Статистика заказов пользователя для администратора
     *
     * @param $id
     * @return mixed
     */
    public function statistic($id)
    {
        $orders = Order::where('user_id', $id)->paginate(20);
        foreach ($orders as $order) {
            $order->user = json_decode($order->user_info, true);
            $order->date = $order->updated_at->format('d.m.Y');
            $order->time = $order->updated_at->format('H:i');
            if ($order->status_id) {
                if ($order->status_id == 1){
                    $order->class = 'warning';
                } else {
                    $order->class = 'info';
                }
            } else {
                $order->class = 'danger';
            }
        }
        return view('admin.orders.index', [
            'orders' => $orders,
            'user'   => User::find($id),
            'order_status' => OrderStatus::all()
        ]);
    }

    /**
     * Отображение отзывов пользователя о товарах для администратора
     *
     * @param $id
     * @return mixed
     */
    public function reviews($id)
    {
        $all_reviews = Review::where('user_id', $id)->paginate(10);

        $new_reviews = [];
        $reviews = [];

        foreach ($all_reviews as $review) {
            if($review->new) {
                $new_reviews[] = $review;
            } else {
                $reviews[] = $review;
            }
        }

        return view('admin.reviews.index', [
        'user'              => User::find($id),
            'new'           => $new_reviews,
            'reviews'       => $reviews,
            'all_reviews'   => $all_reviews
        ]);
    }

    /**
     *  Отображение списка добавленных пользователем товаров в список избранных для администратора
     *
     * @param $id
     * @param Product $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminWishlist($id, Product $product)
    {
        $user = User::find($id);
        $wishlist = $user->wishlist();

        return view('admin.users.wishlist', [
            'wishlist'   => $wishlist,
            'user'       => $user
        ]);
    }

    /**
     * Обратный звонок
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function recall(Request $request, Setting $setting, Product $product){
        $rules = [
            'name'  => 'required',
            'phone' => 'required|regex:/^[0-9\-! ,\'\"\/+@\.:\(\)]+$/'
        ];

        $messages = [
            'name.required'     => 'Вы не указали имя!',
            'phone.required'    => 'Вы не указали телефон!',
            'phone.regex'       => 'Некорректный номер телефона!'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            $errors = $validator->messages();
            return response()->json(['error' => $errors]);
        }

        $data = [
            'name' => $request->name,
            'phone' => $request->phone
        ];

        if(!empty($request->comment)){
            $data['comment'] = $request->comment;
        }

        if(!empty($request->product)){
            $data['product'] = $product->find($request->product);
        }

        Mail::send('emails.recall', $data, function($msg) use ($setting){
            $msg->from('info@vagro.com.ua', 'Интернет-магазин ВерхАгро');
            $msg->to(get_object_vars($setting->get_setting('notify_emails')));
            $msg->subject('Обратный звонок');
        });

        return response()->json(['success' => true]);
    }

    /**
     * Публичная страница пользователя
     *
     * @param Request $request
     * @param User $users
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function company(Request $request, User $users, $id){
        $user = $users->find($id);

        return view('public.personal_page', [
            'partition' => 'catalog',
            'user'      => $user,
            'gallery'   => $user->user_data->gallery,
            'category'  => $user->categories()->first(),
            'attributes'  => $user->attributes()->groupBy('id')->with('attribute')->get()->groupBy('attribute.name')
        ]);
    }

}
