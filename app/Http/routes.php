<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/**
 * Locale
 */
Route::get('setlocale/{locale}', function ($locale) {

    if (in_array($locale, \Config::get('app.locales'))) {   # Проверяем, что у пользователя выбран доступный язык
        Session::put('locale', $locale);                    # И устанавливаем его в сессии под именем locale
    }

    return redirect()->back();                              # Редиректим его <s>взад</s> на ту же страницу

});

/**
 * Admin routing
 */
Route::group(['middleware' => ['admin'], 'prefix' => 'admin'], function(){
    Route::get('/', 'AdminController@dash');

    Route::get('/settings', 'SettingsController@index');
    Route::post('/settings', 'SettingsController@update');

    Route::post('/upload_attribute_image', 'AttributesController@upload_image');

    Route::group(['prefix' => 'units'], function(){
        Route::get('/', 'UnitsController@index');
        Route::get('/create', 'UnitsController@create');
        Route::post('/create', 'UnitsController@store');
        Route::get('/delete/{id}', 'UnitsController@destroy');
        Route::get('/edit/{id}', 'UnitsController@edit');
        Route::post('/edit/{id}', 'UnitsController@update');
        Route::post('/schemes', 'UnitsController@schemes');
    });

    Route::group(['prefix' => 'categories'], function(){
        Route::get('/', 'CategoriesController@index');
        Route::get('/create', 'CategoriesController@create');
        Route::post('/create', 'CategoriesController@store');
        Route::get('/delete/{id}', 'CategoriesController@destroy');
        Route::get('/edit/{id}', 'CategoriesController@edit');
        Route::post('/edit/{id}', 'CategoriesController@update');
    });

    Route::group(['prefix' => 'attributes'], function(){
        Route::get('/', 'AttributesController@index');
        Route::get('/create', 'AttributesController@create');
        Route::post('/create', 'AttributesController@store');
        Route::get('/delete/{id}', 'AttributesController@destroy');
        Route::get('/edit/{id}', 'AttributesController@edit');
        Route::post('/edit/{id}', 'AttributesController@update');
    });

    Route::group(['prefix' => 'products'], function(){
        Route::any('/', 'ProductsController@index');
        Route::get('/create', 'ProductsController@create');
        Route::post('/create', 'ProductsController@store');
        Route::get('/delete/{id}', 'ProductsController@destroy');
        Route::get('/edit/{id}', 'ProductsController@edit');
        Route::post('/edit/{id}', 'ProductsController@update');
        Route::get('/getattributevalues', 'ProductsController@getAttributes');
        Route::post('/getattributevalues', 'ProductsController@getAttributeValues');
    });
    Route::match(['get', 'post'], '/upload-products', 'ProductsController@upload');

    Route::group(['prefix' => 'articles'], function(){
        Route::get('/', 'ArticlesController@index');
        Route::get('/create', 'ArticlesController@create');
        Route::post('/create', 'ArticlesController@store');
        Route::get('/edit/{id}', 'ArticlesController@edit');
        Route::post('/edit/{id}', 'ArticlesController@update');
        Route::get('/delete/{id}', 'ArticlesController@destroy'); //softDelete
    });

    Route::group(['prefix' => 'users'], function(){
        Route::get('/', 'UserController@index');
        Route::get('/create', 'UserController@create');
        Route::post('/create', 'UserController@store');
        Route::get('/edit/{id}', 'UserController@edit');
        Route::post('/edit/{id}', 'UserController@update');
        Route::get('/stat/{id}', 'UserController@statistic');
        Route::get('/reviews/{id}', 'UserController@reviews');
        Route::get('/wishlist/{id}', 'UserController@adminWishlist');
        Route::get('/delete/{id}', 'UserController@destroy'); //softDelete
    });

    Route::group(['prefix' => 'orders'], function(){
        Route::get('/', 'OrdersController@index');
        Route::get('/create', 'OrdersController@create');
        Route::post('/create', 'OrdersController@store');
        Route::get('/edit/{id}', 'OrdersController@edit');
        Route::post('/edit/{id}', 'OrdersController@update');
        Route::post('/stat/{id}', 'OrdersController@statistic');
        Route::get('/delete/{id}', 'OrdersController@destroy'); //softDelete
    });
    Route::group(['prefix' => 'pages'], function(){
        Route::get('/', 'PagesController@index');
        Route::get('/create', 'PagesController@create');
        Route::post('/create', 'PagesController@store');
        Route::get('/edit/{id}', 'PagesController@edit');
        Route::post('/edit/{id}', 'PagesController@update');
        Route::get('/delete/{id}', 'PagesController@destroy'); //softDelete
    });

    Route::group(['prefix' => 'modules'], function(){
        Route::get('/', 'ModulesController@index');
        Route::get('/settings/{name}', function($name) {
            $controller = App::make('\App\Http\Controllers\ModulesController');
            return $controller->callAction('getModule', [$name]);
        });
        Route::post('/settings/{name}', function($name) {
            $controller = App::make('\App\Http\Controllers\ModulesController');
            return $controller->callAction('setModule', [$name]);
        });
    });

    Route::group(['prefix' => 'reviews'], function(){
        Route::get('/', 'ReviewsController@index');
        Route::get('/show/{id}', 'ReviewsController@show');
        Route::post('/show/{id}', 'ReviewsController@update');
        Route::get('/delete/{id}', 'ReviewsController@destroy'); //softDelete
    });

    Route::get('/loadimages', 'ImagesController@loadImages');
    Route::post('/upload', 'ImagesController@uploadImages');

    Route::group(['prefix' => 'images'], function(){
        Route::post('/start_updating', 'ImagesController@startUpdatingImages');
        Route::post('/update_sizes', 'ImagesController@updateImageSize');
        Route::post('/remove_images', 'ImagesController@removeImages');
    });
});

/**
 * Web routing
 */
Route::group(['middlewareGroup' => ['web']], function() {
    Route::get('/', 'MainController@index');
    Route::get('/about', function(){
        return view('public/about');
    });
    Route::get('/contacts', function(){
        return view('public/contacts');
    });
    Route::get('/catalog', 'CategoriesController@all_categories');
    Route::get('/catalog/{alias}', 'CategoriesController@show');
    Route::get('/news', 'ArticlesController@showAll');
    Route::get('/news/{alias}', 'ArticlesController@show');
    Route::match(['get', 'post'], '/search', ['as' => 'search', 'uses' => 'ProductsController@search']);
    Route::post('/review/add', 'ReviewsController@add');
    Route::post('/review/add-likes', 'ReviewsController@addLikes');

    /**
     * Authorization and account routing
     */
    Route::post('/login', 'LoginController@authenticate');
    Route::get('/logout', 'LoginController@logout');
    Route::post('/registration', 'LoginController@store');
    Route::get('/forgotten', 'LoginController@forgotten');
    Route::post('/forgotten', 'LoginController@reminder');
    Route::get('/lostpassword', 'LoginController@lostpassword');
    Route::post('/lostpassword', 'LoginController@changePassword');
    Route::group(['prefix' => 'user', 'middleware' => ['user']], function () {
        Route::get('/', 'UserController@show');
        Route::post('/change-data', 'UserController@saveChangedData');
    });

    /**
     * Wishlist operations
     */
    Route::post('wishlist/update', 'WishListController@update');
    Route::post('wishlist/del', 'WishListController@delWishlist');

    /**
     * Cart and checkout routing
     */
    Route::post('/subscribe', 'UserController@subscribe');
    Route::get('/livesearch', 'ProductsController@livesearch');
    Route::post('/recall', 'UserController@recall');
});