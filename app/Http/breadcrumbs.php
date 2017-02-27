<?php

/**
 * Home
 */
Breadcrumbs::register('home', function($breadcrumbs) {
    $breadcrumbs->push('Главная', url('/'));
});

/**
 * User
 */
Breadcrumbs::register('user', function($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Личный кабинет', url('/user'));
    $breadcrumbs->push('Личные данные');
});

Breadcrumbs::register('history', function($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Личный кабинет', url('/user'));
    $breadcrumbs->push('История заказов');
});

Breadcrumbs::register('wishlist', function($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Личный кабинет', url('/user'));
    $breadcrumbs->push('Список желаний');
});

Breadcrumbs::register('change_user', function($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Личный кабинет', url('/user'));
    $breadcrumbs->push('Изменение личных данных');
});

/**
 * Catalog
 */
Breadcrumbs::register('catalog', function($breadcrumbs, $category, $brand, $model, $unit = '') {
    $breadcrumbs->parent('home');
    if (is_object($category)) {
        $breadcrumbs->push($category->name, url('/catalog/' . $category->url_alias));
    }

    if (is_object($brand)) {
        $breadcrumbs->push($brand->name, url('/catalog/' . $brand->url_alias));
    }

    if (is_object($model)) {
        $breadcrumbs->push($model->name, url('/catalog/' . $model->url_alias));
    }

    if (is_object($unit)) {
        $breadcrumbs->push($unit->name, url('/unit/' . $unit->url_alias));
    }

});

/**
 * Actions
 */
Breadcrumbs::register('sale', function($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Акции', url('/sale/'));
});

/**
 * Brand
 */
Breadcrumbs::register('brand', function($breadcrumbs, $brand) {
    $breadcrumbs->parent('home');
    if (is_object($brand)) {
        $breadcrumbs->push($brand->name, url('/catalog/' . $brand->url_alias));
    }
});

/**
 * Articles
 */
Breadcrumbs::register('articles', function($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Новости', url('/news'));
});

Breadcrumbs::register('articles_item', function($breadcrumbs, $article) {
    $breadcrumbs->parent('articles');
    $breadcrumbs->push($article->title);
});

/**
 * HTML Pages
 */
Breadcrumbs::register('html', function($breadcrumbs, $page) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push($page->name);
});

/**
 * Login and register
 */
Breadcrumbs::register('login', function($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Авторизация', url('/login'));
});

Breadcrumbs::register('register', function($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Регистрация');
});

Breadcrumbs::register('forgotten', function($breadcrumbs) {
    $breadcrumbs->parent('login');
    $breadcrumbs->push('Восстановление пароля');
});

Breadcrumbs::register('account', function($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Личный кабинет');
});
/**
 * Products
 */
Breadcrumbs::register('product', function($breadcrumbs, $product) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push($product->name);
});

/**
 * Search
 */

Breadcrumbs::register('search', function($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Поиск', url('/search'));
});

/**
 * Contacts
 */

Breadcrumbs::register('contacts', function($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Контакты', url('/contacts'));
});

Breadcrumbs::register('order', function($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Корзина.Оформление заказа', url('/order'));
});