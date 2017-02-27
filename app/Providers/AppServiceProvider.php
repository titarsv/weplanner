<?php

namespace App\Providers;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Illuminate\Support\Facades\Cache;

use App\Models\Setting;
use App\Models\User;
use App\Models\Review;
use App\Models\Album;
use App\Models\Category;

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
            $categories = new Category();
            $view->with([
                'categories' => $categories->get_parent_categories()
            ]);
        });

        /**
         * Последние портфолио
         */
        view()->composer(['public.layouts.providers_portfolio'], function($view){
            $albums = new Album();
            $view->with([
                'posts' => $albums->get_portfolios()
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
