<?php

namespace App\Providers;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Illuminate\Support\Facades\Cache;

use App\Models\Setting;
use App\Models\Wishlist;
use App\Models\User;
use App\Models\Review;
use App\Models\Image;
use App\Models\Term;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Setting $setting)
    {

        $user = Sentinel::getUser();
        if(!is_null($user)) {
            $user = User::find($user->id);
        }

        $settings = $setting->get_global();

        if(!is_null($user)) {

            $reviews = Review::where('new', 1)->count();

            view()->composer('admin.layouts.main', function($view) use ($user, $reviews) {
                $view->with([
                    'user'          => $user,
                    'new_reviews'   => $reviews
                ]);
            });

            $roles_array = [];
            $roles = Sentinel::getRoles()->toArray();
            foreach($roles as $role){
                $roles_array[] = $role['slug'];
            }

            view()->composer(['public.layouts.main_menu', 'index'], function($view) use ($roles_array, $user){
                $view->with('user_logged', true)
                    ->with('user_roles', $roles_array)
                    ->with('user', $user);
            });
        }else{
            view()->composer(['public.layouts.main_menu', 'index'], function($view) use ($user){
                $view->with('user_logged', false)
                    ->with('user', $user);
            });
        }

        view()->composer([
            'public/*', 'users/*', 'index', 'login', 'register'
        ], function($view) use ($settings, $user) {

            $view->with([
                'settings' => $settings
            ]);
        });

        /**
         * Категории
         */
        view()->composer(['public.layouts.categories'], function($view){
            $terms = new Term();
            $view->with([
                'categories' => $terms->get_parent_categories()
            ]);
        });

        /**
         * Категории в боковом меню
         */
        view()->composer([
            'public.layouts.sidebar-menu',
        ], function($view) use ($settings, $user) {
            $categories = Category::where('status', 1)->where('parent_id', 0)->get();
            $view->with([
                'root_categories' => $categories,
            ]);
        });

        /**
         * Рекомендуемые новости
         */
        view()->composer(['public.layouts.recommended-news'], function($view){
            $view->with([
                'recommended' => Article::where('published', 1)->orderBy('visits', 'desc')->take(2)->get()
            ]);
        });

        /**
         * Выбранный город
         */
        view()->composer(['public.layouts.header-main', 'public.layouts.footer', 'public.product'], function($view){
            $view->with([
                'selected_city' => !empty($_COOKIE['selected_city']) ? $_COOKIE['selected_city'] : 'Харьков',
                'branches' => ['Харьков', 'Киев', 'Одесса', 'Днепр']
            ]);
        });

        /**
         * Модуль баннерров
         */
        view()->composer(['public.layouts.sidebar-banners'], function($view){
            $banners_settings = Module::select(['settings', 'status'])->where('alias_name', 'banners')->first();
            $banners = [];
            if($banners_settings->status){
                $settings = json_decode($banners_settings->settings, true);
                if(isset($settings['banners'])) {
                    $banners = $settings['banners'];
                    foreach ($banners as $id => $banner){
                        $image = new Image();
                        $banners[$id]['image'] = $image->get_file_url((int)$banner['image_id'], 'slide');
                    }
                }
            }
            $view->with([
                'banners' => $banners
            ]);
        });

        /**
         * Последние отзывы
         */
        view()->composer(['public.layouts.last-reviews'], function($view){
            $reviews = new Review();
            $view->with([
                'reviews' => $reviews->where('published', 1)
                    ->take(2)
                    ->orderBy('id', 'desc')
                    ->groupBy('product_id')
                    ->with('product.image', 'user')
                    ->get()
            ]);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
