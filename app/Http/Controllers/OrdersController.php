<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Mail;
use App\Models\Settings;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use App\Models\Order;
use App\Models\Products;
use App\Models\Modules;
use App\Models\OrderStatus;
use App\Models\ProductsInOrder;
use App\Models\User;
use App\Models\UserData;
use App\Models\Cart;
use App\Models\ProductsCart;
use Carbon\Carbon;
use Cartalyst\Sentinel\Native\Facades\Sentinel;

use Illuminate\Support\Facades\Session;

class OrdersController extends Controller
{

    public function index(Request $request)
    {
        if (isset($request->status)) {
            $orders = Order::where('status_id', $request->status)->orderBy('id', 'desc')->paginate(20);
        } elseif (isset($request->weeks)) {
            $date = Carbon::now()->subWeek(2);
            $orders = Order::where('created_at', '>', $date)->orderBy('id', 'desc')->paginate(20);
        } else {
            $orders = Order::orderBy('id', 'desc')->paginate(20);
        }

        foreach ($orders as $order) {
            $order->user = json_decode($order->user_info, true);
            $order->date = $order->created_at->format('d.m.Y');
            $order->time = $order->created_at->format('H:i');
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
            'order_status' => OrderStatus::all()
        ]);
    }

    public function edit($id)
    {
        $order = Order::find($id);

        $order->user = json_decode($order->user_info);
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

        return view('admin.orders.edit', [
            'order' => $order,
            'orders_statuses' => OrderStatus::all()
        ]);
    }

    public function show()
    {
        if(Session::has('user_cart_id')) {
            $user_cart_id = Session::get('user_cart_id');
            $current_cart = Cart::where('user_cart_id', $user_cart_id)->first();
            if(is_null($current_cart)){
                return redirect('/');
            }
            if($current_cart->products_sum < 750){
                return redirect('/');
            }
        }

        if(Sentinel::check()){
            $adress = User::find(Sentinel::check()->id)->user_data->adress;
//            return dd($adress);
            return view('public.order')->with('adress', json_decode($adress));
        }
        return view('public.order');
    }

    public function update($id, Request $request)
    {
        $status_id = $request->status;
        $order = Order::find($id)->update([
            'status_id' => $status_id
        ]);
//        return dd($order);
        $orders = Order::all();
        return redirect('/admin/orders')
            ->with('message-success', 'Заказ № ' . $id . ' успешно обновлен.');
    }

    public function newOrderUser(Request $request)
    {
        $user_id = Sentinel::check()->id;
        $rules = [
            'first_name'            => 'required',
            'phone'                 => 'required|regex:/^[0-9\-! ,\'\"\/+@\.:\(\)]+$/',
            'email'                 => 'required|email'
        ];
        $messages = [
            'first_name.required'    => 'Не заполнены обязательные поля!',
            'phone.required'         => 'Не заполнены обязательные поля!',
            'phone.regex'            => 'Некорректный телефон!',
            'email.required'         => 'Не заполнены обязательные поля!',
            'email.email'            => 'Некорректный email-адрес!',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
        }
        User::find($user_id)->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name
        ]);

        $adress = json_encode([
            'city' => $request->city,
            'street' => $request->street,
            'house' => $request->house,
            'flat' => $request->flat
        ]);
        UserData::where('user_id', $user_id)->update([
            'adress' => $adress,
            'other_data' => json_encode($request->except(['_token', 'first_name', 'last_name', 'city', 'street', 'house', 'flat'])),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        $order_data = json_encode($request->except(['_token', 'first_name', 'last_name', 'email', 'phone', 'password', 'password_confirmation']));

        $this->orderStore($user_id, $order_data);
        return redirect('/user/history')
            ->with('status', 'Ваш заказ оформлен.');
    }

    public function newOrder(Request $request)
    {
//        return dd($request);
        $password = $request->password ? $request->password : 'null';
        $order_data = json_encode($request->except(['_token', 'first_name', 'last_name', 'email', 'phone', 'password', 'password_confirmation']));
        $rules = [
            'first_name'            => 'required',
            'phone'                 => 'required|regex:/^[+0-9\-! ,\'\"\/+@\.:\(\)]+$/'
        ];
        $messages = [
            'first_name.required'    => 'Не заполнены обязательные поля!',
            'phone.required'         => 'Не заполнены обязательные поля!',
            'phone.regex'            => 'Некорректный телефон!',
        ];

        $user_exists = User::where('phone', $request->phone)->first();
//        $user_exists = User::where('email', $request->email)->first();
//        return dd($user_exists);
        if($request->registration == 'on'){
            // если юзер хочет регистрироваться, то надо проверить на уникальность номер и почту

            $rules['phone'] = 'required|unique:users';
            $rules['email'] = 'required|email|unique:users';//точно уник?
            
			if ($user_exists){
                $user = Sentinel::findById($user_exists->id);
                if($user->inRole('unregister_user')){
            //        $rules['email'] = 'required|email';
                    $rules['phone'] = 'required';
                }
            }

            $rules['password'] = 'required|min:6|confirmed';
            $rules['password_confirmation'] = 'required|min:6';

            $messages['password.required'] = 'Не заполнены обязательные поля!';
            $messages['password.min'] = 'Пароль должен быть не менее 6 символов!';
            $messages['password.confirmed'] = 'Введенные пароли не совпадают!';
            $messages['email.unique'] = 'Пользователь с таким email-ом уже зарегистрирован!';
            $messages['phone.unique'] = 'Пользователь с таким номером уже зарегистрирован!';
            $messages['email.required'] = 'Не заполнены обязательные поля!';
            $messages['email.email'] = 'Некорректный email-адрес!';
        }
		
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
        }
		
//        Прошли валидацию. ищем юзера по id и проверяем его роль

        if ($user_exists){// если юзер есть . 04.10.2016 -> уже не надо условие. Все юзеры анрег
            $user = Sentinel::findById($user_exists->id);
            $user_id = $user->id;
            if($user->inRole('unregister_user')){   // если юзер есть и незареган 04.10.2016 -> уже не надо условие. Все юзеры анрег
//                return dd($request);
//                если не хотим регистрироваться, то зпишем в базу заказ и радуемся
                if($request->registration == 'off'){
//                    return dd($request);
                    $data = UserData::create([
                        'user_id' => $user_id,
                        'image_id' => 1
                    ]);
                    $data->save();
                    $this->orderStore($user_id, $order_data);        // записываем в базу и радуемся
                    return redirect('/thank_you')
                        ->with('order_status', 'Ваш заказ оформлен. Оператор свяжется с вами в ближайшее время.');
                }
				
                $credentials = [
                    'email' => $request->email,
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'password' => $request->password,
                    'permissions' => [
                        'user' => true
                    ]
                ];
//                return dd($credentials);

				$data = UserData::create([
					'user_id' => $user_id,
                    'image_id' => 1
				]);
		        $data->save();
				
                $user_update = Sentinel::update($user, $credentials);

                $role = Sentinel::findRoleBySlug('unregister_user');
                $role->users()->detach($user);

                $userRole = Sentinel::findRoleBySlug('user');
                $userRole->users()->attach($user);
				

                $get_order = $this->orderStore($user_id, $order_data);        // записываем в базу заказ и радуемся
//                return dd($get_order);
//                $data = UserData::where('user_id', $user_id)->first();
//                $data->phone = $request->phone;
//                $data->save();

                $auth = Sentinel::authenticateAndRemember($credentials);
				
                if($auth){
                    return redirect('/user/history')
                        ->with('status', 'Ваш заказ оформлен. Оператор свяжется с вами в ближайшее время.');
                }else{
                    return redirect()
                        ->back()
                        ->withInput()
                        ->withErrors(['error' => 'При регистрации произошла ошибка!']);
                }

            }else{
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors(['phone' => 'Пользователь с таким номером телефона уже зарегистрирован!']);
            }
        }

//        return dd($request);
//        if($request->registration == 'off'){
//            $user_role = Sentinel::findRoleBySlug('unregister_user');
//            $credentials['permissions'] = ['unregistered' => true];
//        }else{
//            $user_role = Sentinel::findRoleBySlug('user');
//            $credentials['permissions'] = ['user' => true];
//        }
//        $credentials = [
//            'email' => $request->email,
//            'phone' => $request->phone,
//            'password' => $password,
//            'first_name' => $request->first_name,
//            'last_name' => $request->last_name
//        ];
////        return dd($credentials);
//
//        $new_user = Sentinel::registerAndActivate($credentials);
//
//        $user_role->users()->attach($new_user);
//        $user_id = $new_user->id;
//
//        $data = UserData::create([
//            'user_id' => $user_id,
////            'phone' => $request->phone
//        ]);
//        $data->save();
//
//        $this->orderStore($user_id, $order_data);        // записываем в базу и радуемся заказу
//
//        UserData::create([
//            'user_id'   => $user_id,
//            'image_id'  => 1,
////            'phone'     => $request->phone,
//            'created_at' => Carbon::now(),
//            'updated_at' => Carbon::now()
//        ]);
//        if($request->registration == 'on') {
//            $auth = Sentinel::authenticateAndRemember($credentials);
//            if ($auth) {
//                return redirect('/user/history')
//                    ->with('status', 'Ваш заказ оформлен. Оператор свяжется с вами в ближайшее время.');
//            }
//        }else{
//            return redirect('/thank_you')
//                ->with('order_status', 'Ваш заказ оформлен. Оператор свяжется с вами в ближайшее время.');
//        }
    }

    /**
     * @param $user_id
     * @param $order_data
     * @return bool
     */
    public function orderStore($user_id, $order_data)
    {
        $user_cart_id = Session::get('user_cart_id');

        $current_cart = Cart::where('user_cart_id', $user_cart_id)->first();

        $new_order_data = [
            'user_id' => $user_id,
            'products_sum' => $current_cart->products_sum,
            'products_quantity' => $current_cart->products_quantity,
            'status_id' => 1,
            'order_data' => $order_data
        ];
        $new_order = Order::create($new_order_data);

        foreach($current_cart->products_cart as $products){
            $products_in_cart['product_id'] = $products->product->id;
            $products_in_cart['product_quantity'] = $products->product_quantity;
            $products_in_cart['product_sum'] = $products->product_quantity * $products->product->price;

            $new_products_cart = new ProductsInOrder($products_in_cart);
            $new_order->products()->save($new_products_cart);
        }
        $current_cart->delete();

        $new_user_cart_id = md5(rand(0,100500));
        Session::put('user_cart_id', $new_user_cart_id);


        $emails = json_decode(Settings::find(1)->value('notify_emails'));

        Mail::send('emails.order', ['emails', $emails], function($msg) use ($emails){
            $msg->from('parfumhouse@parfumhouse.com.ua', 'Интернет-магазин Parfum House');
            $msg->to($emails);
            $msg->subject('Новый отзыв на сайте!');
        });


        $user_data = User::find($user_id);

        /*
         * Экспорт в битрикс24
         */
        $products_data = '';
        foreach($new_order->products as $product){
            foreach ($product->product->attributes as $atributes) {
                if ($atributes->attribute_id == 1) {
                    $value = $atributes->value->name;
                }
            }
            $products_data .=
                'Артикул: '.$product->product->articul
                .' Товар: '.$product->product->name
                .' Производитель: '.$value
                .'. Количество: '.$product->product_quantity
                .'. Сумма: '.$product->product_sum.'<br>';
        }
        $bitrix_data = [
            'phone' => $user_data->phone,
            'mail_skype' => $user_data->email,
            'name' => $user_data->last_name.' '.$user_data->first_name,
            'content' => $user_data,
            'order' => 'Сумма: '.$new_order_data['products_sum'].', количество товаров: '.$new_order_data['products_quantity'],
            'products' => $products_data
        ];

        $export = new ExportDataController();
        $export->toBitrix($bitrix_data);

        return true;
    }

    public function thank_you()
    {
        $modules_settings = Modules::all();

        foreach ($modules_settings as $module_setting) {
            if ($module_setting->alias_name == 'latest') {
                $latest_settings = json_decode($module_setting->settings);
            }
        }
        $latest_products = Products::orderBy('created_at', 'desc')->take($latest_settings->quantity)->get();
        return view('public.thanks')->with('latest_products', $latest_products);
    }

    public function startData(Request $request)
    {
        $user_exists = User::where('phone',$request->phone)->first();
        if($user_exists){
            return;
        }

        $user_role = Sentinel::findRoleBySlug('unregister_user');
        $credentials['permissions'] = ['unregistered' => true];

        $credentials = [
            'phone' => $request->phone,
            'first_name' => $request->first_name,
            'password' => 'null',
            'permissions' => [
                'unregistered' => true
            ]
        ];

        $new_user = Sentinel::registerAndActivate($credentials);
//        $new_user = User::create($credentials);

//        $user_role->users()->attach(Sentinel::findById($new_user->id));
        $user_role->users()->attach($new_user);

        $user_cart_id = Session::get('user_cart_id');
        $current_cart = Cart::where('user_cart_id', $user_cart_id)->first();
        $current_cart->update(['user_id' => $new_user->id]);
        return $new_user;
    }
}
