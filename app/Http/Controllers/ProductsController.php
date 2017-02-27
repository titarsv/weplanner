<?php

namespace App\Http\Controllers;

use App\Attributes;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Product;
use Hamcrest\Core\Set;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use phpDocumentor\Reflection\Types\Object;
use Illuminate\Support\Facades\Cache;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Validator;

use App\Http\Requests;
use App\Models\Category;
use App\Models\Unit;
use App\Models\Setting;
use App\Models\Module;
use App\Models\Image;
use App\Models\Scheme;
use Excel;

class ProductsController extends Controller
{

    private $products;
    private $rules = [
        'name' => 'required|unique:products',
        'price' => 'required|numeric',
        'articul' => 'required|unique:products',
        'quantity' => 'numeric',
        'capacity' => 'numeric',
        'meta_title' => 'required|max:75',
        'meta_description' => 'max:180',
        'meta_keywords' => 'max:180',
        'url_alias' => 'required|unique:products|unique:categories',
    ];

    private $messages = [
        'name.required' => 'Поле должно быть заполнено!',
        'name.unique' => 'Название товара должно быть уникальным!',
        'price.required' => 'Поле должно быть заполнено!',
        'price.numeric' => 'Значение должно быть числовым!',
        'articul.required' => 'Поле должно быть заполнено!',
        'articul.unique' => 'Артикул товара должен быть уникальным!',
        'quantity.numeric' => 'Значение должно быть числовым!',
        'capacity.numeric' => 'Значение должно быть числовым!',
        'meta_title.required' => 'Поле должно быть заполнено!',
        'meta_title.max' => 'Максимальная длина заголовка не может превышать 75 символов!',
        'meta_description.max' => 'Максимальная длина описания не может превышать 180 символов!',
        'meta_keywords.max' => 'Максимальная длина ключевых слов не может превышать 180 символов!',
        'url_alias.required' => 'Поле должно быть заполнено!',
        'url_alias.unique' => 'Значение должно быть уникальным для каждой категории!',
    ];

    public $sort = [
        'date_added' => [
            'name'  => 'Дата добавления',
            'dest'  => 'DESC',
            'sort'  => 'created_at'
        ],
        'date_modified' => [
            'name'  => 'Дата изменения',
            'dest'  => 'DESC',
            'sort'  => 'updated_at'
        ],
        'name_asc' => [
            'name'  => 'Имя (А-Я)',
            'dest'  => 'ASC',
            'sort'  => 'name'
        ],
        'name_desc' => [
            'name'  => 'Имя (Я-А)',
            'dest'  => 'DESC',
            'sort'  => 'name'
        ]
    ];

    public $show = [15,30,45,60];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $category_id = false;
        $stock = false;
        $current_sort = false;

        if($request->sort) {
            $current_sort = $this->sort[$request->sort];
            $current_sort['value'] = $request->sort;
        }

        if($request->show) {
            if ($request->cookie('show_list') == null || $request->cookie('show_list') !== $request->show) {
                Cookie::queue('show_list', $request->show);
            }
            $current_show = $request->show;
        } else {
            if ($request->cookie('show_list') == null) {
                Cookie::queue('show_list', 15);
                $current_show = 15;
            } else {
                $current_show = $request->cookie('show_list');
            }
        }



        if (isset($request->category)) {
            $category_id = $request->category;
        }
        if (isset($request->stock)) {
            $stock = $request->stock;
        }

        if ($request->search) {
            $search = $this->search(new Product, $request);
            $products = $search->products;
            $current_search = $request->search;
        } else {
            $products = Product::when($category_id, function($query) use ($category_id){
                return $query->where('product_category_id', $category_id);
            })
                ->when(($stock !== false), function($query) use ($stock){
                    return $query->where('stock', $stock);
                })
                ->when($current_sort, function($query) use ($current_sort){
                    return $query->orderBy($current_sort['sort'], $current_sort['dest']);
                })
                ->paginate($current_show);
            $current_search = false;
        }

        return view('admin.products.index', [
            'products' => $products,
            'categories' => Category::all(),
            'array_sort' => $this->sort,
            'current_sort' => $current_sort,
            'array_show' => $this->show,
            'current_show' => $current_show,
            'current_search' => $current_search
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = $products = Cache::tags('products')->remember('all_products', 120, function() {
            return Product::all();
        });

        return view('admin.products.create', [
            //'categories' => Category::all(),
            'attributes' => Attribute::all(),
            'units' => Unit::all(),
            'products'   => $products
        ]);
    }

    /**
     * Создание товара
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Image $image, Product $products)
    {
        $attributes_error = $this->validate_attributes($request->product_attributes);

        $validator = Validator::make($request->all(), $this->rules, $this->messages);

        $image_href = $image->find($request->image_id)->href;
        $request->merge(['href' => $image_href]);

        if ($validator->fails() || $attributes_error) {
            return redirect()
                ->back()
                ->withInput()
                ->with('message-error', 'Сохранение не удалось! Проверьте форму на ошибки!')
                ->withErrors($validator)
                ->with('attributes_error', $attributes_error);
        }

        $request->merge(['gallery' => json_encode($request->gallery)]);

        $data = ['products' => $request->except('_token', 'units', 'product_scheme', 'product_attributes', 'href')];

        if (!empty($request->product_attributes)) {
            $data['product_attributes'] = [];
            foreach ($request->product_attributes as $attribute) {
                $data['product_attributes'][] = [
                    'attribute_id' => $attribute['id'],
                    'attribute_value_id' => $attribute['value']
                ];
            }
        }

        if (!empty($request->units)) {
            $data['unit_products'] = [];
            foreach ($request->units as $unit) {
                $data['unit_products'][] = [
                    'unit_id' => $unit
                ];
            }
        }

        if (!empty($request->product_scheme)) {
            $data['scheme_products'] = [];
            foreach ($request->product_scheme as $scheme => $position) {
                $data['scheme_products'][] = [
                    'scheme_id' => $scheme,
                    'position_id' => $position
                ];
            }
        }

        $products->insert_product($data);

        return redirect('/admin/products')
            ->with('message-success', 'Товар ' . $products->name . ' успешно добавлен.');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id, Product $product)
    {
        $products = $products = Cache::tags('products')->remember('all_products', 120, function() {
            return Product::all();
        });

        $product = $product->find($id);

        $added_units = [];
        foreach ($product->units as $unit){
            $added_units[] = $unit->id;
        }

        $added_schemes = [];

        $schemes_positions = $product->schemes_positions->groupBy('scheme_id')->toArray();
        $positions = [];
        foreach ($schemes_positions as $id => $scheme){
            foreach ($scheme as $pos) {
                $positions[$id][] = $pos['position_id'];
            }
        }

        $analogs_ids = [];
        foreach($product->analogs as $analog){
            $analogs_ids[] = $analog->id;
        }

        return view('admin.products.edit', [
            'product' => $product,
            'units' => Unit::all(),
            'added_units' => $added_units,
            'schemes' => Scheme::whereIn('unit_id', $added_units)->get(),
            'added_schemes' => $added_schemes,
            'attributes' => Attribute::all(),
            'schemes_positions' => $positions,
            'products' => $products,
            'analogs_ids' => $analogs_ids
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, Image $image)
    {
        $rules = $this->rules;
        $rules['name'] = 'required|unique:products,name,'.$id;
        $rules['articul'] = 'required|unique:products,articul,'.$id;
        $rules['url_alias'] = 'required|unique:categories|unique:products,url_alias,'.$id;

        $attributes_error = $this->validate_attributes($request->product_attributes);

        $validator = Validator::make($request->all(), $rules, $this->messages);

        if ($validator->fails() || $attributes_error) {

            $image_href = $image->find($request->image_id)->href;

            $request->merge(['href' => $image_href]);

            return redirect()
                ->back()
                ->withInput()
                ->with('message-error', 'Сохранение не удалось! Проверьте форму на ошибки!')
                ->withErrors($validator)
                ->with('attributes_error', $attributes_error);
        }

        $product = Product::find($id);

        $product->fill($request->except(['_token', 'gallery', 'product_attributes', 'href']));

        if(empty($request->analogs)){
            $product->analogs = [];
        }

        $product->gallery = json_encode($request->gallery);

        $product->push();

        Cache::tags('products')->flush();

        if(!empty($request->units))
            $product->units()->sync($request->units);

        $product->attributes()->delete();
        if (!empty($request->product_attributes)) {
            foreach ($request->product_attributes as $attribute) {
                $product_attributes[] = [
                    'product_id' => $product->id,
                    'attribute_id' => $attribute['id'],
                    'attribute_value_id' => $attribute['value']
                ];
            }

            $product->attributes()->createMany($product_attributes);
        }

        $product->schemes_positions()->delete();
        if (!empty($request->product_scheme)) {
            $schemes_positions = [];
            foreach ($request->product_scheme as $scheme => $position){
                $schemes_positions[] = [
                    'scheme_id' => $scheme,
                    'position_id' => $position
                ];
            }

            $product->schemes_positions()->createMany($schemes_positions);
        }

        $route = 'admin/products';
        if ($request->page)
            $route .= '?page=' . $request->page;

        return redirect($route)
            ->with('message-success', 'Товар ' . $product->name . ' успешно отредактирован.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect()->back()
            ->with('message-success', 'Товар ' . $product->name . ' успешно удален.');
    }

    /**
     * Получение списка всех атрибутов
     * @param Attribute $attributes
     * @return string|void
     */
    public function getAttributes(Attribute $attributes)
    {

        $attr = $attributes->all();
        $response = [];

        if(!empty($attr)){
            foreach ($attr as $attribute) {
                $response[] = [
                    'attribute_id'    => $attribute->id,
                    'attribute_name'  => $attribute->name
                ];
            }
        }

        return json_encode($response);

    }

    /**
     * Получение списка значений переданного атрибута
     * @param Attribute $attributes
     * @param Request $request
     * @return string|void
     */
    public function getAttributeValues(Attribute $attributes, Request $request)
    {

        $attribute = $attributes->find((int)$request->attribute_id);
        $response = [];

        if ($attribute !== null) {
            foreach ($attribute->values as $value) {
                $response[] = [
                    'attribute_value_id'    => $value->id,
                    'attribute_value'       => $value->name
                ];
            }
        }

        return json_encode($response);

    }

    /**
     * Живой поиск для модулей
     * @param Request $request
     * @param Product $products
     * @return string|void
     */
    public function livesearch(Request $request, Product $products)
    {
        $results = $products->where('name', 'like', '%' . $request->search . '%')->paginate(5);

        foreach ($results as $result) {

            if ($result) {
                $json[] = [
                    'product_id' => $result->id,
                    'name'       => $result->name
                ];
            }
        }

        if (!empty($json)) {
            return json_encode($json);
        } else {
            return json_encode([['empty' => 'Ничего не найдено!']]);
        }
    }

    /**
     * @param $alias
     * @return mixed
     */
    public function show($alias, Request $request, Product $products)
    {
        $product = $products->where('url_alias', $alias)->first();
        if (is_null($product))
            abort(404);

        setlocale(LC_TIME, 'RU');
        $reviews = $product->reviews()
            ->where('published', 1)
            ->orderBy('created_at', 'desc')
            ->get();

        $product_reviews = [];
        foreach ($reviews as $review) {
            $review->date = iconv("cp1251", "UTF-8", $review->updated_at->formatLocalized('%d.%m.%Y'));
            if(!is_null($review->parent_review_id)){
                $product_reviews[$review->parent_review_id]['comments'][] = $review;
            } else {
                $product_reviews[$review->id]['parent'] = $review;
            }
        }

        $product_attributes = [];

        if(!$product->attributes->isEmpty()) {
            foreach ($product->attributes as $attribute) {
                if (isset($product_attributes[$attribute->info->name])) {
                    $product_attributes[$attribute->info->name] .= ', ' . $attribute->value->name;
                } else {
                    $product_attributes[$attribute->info->name] = $attribute->value->name;
                }
            }
        }

        // Если у товара нет галереи возвращаем его изображение
        if(empty($product->gallery))
            $gallery = [$product->image];
        else
            $gallery = $product->gallery_images();

//        $viewed = json_decode($request->cookie('viewed'), true);
//
//        if(!is_array($viewed))
//            $viewed = [];
//
//        if(!in_array($product->id, $viewed)){
//            if(count($viewed) > 7)
//                array_splice($viewed, -7);
//            $viewed[] = $product->id;
//        }
//
//        if(!is_null($viewed)) {
//            $products_viewed = $products->getProducts($viewed);
//        }

        $product->increment('views');

        return response(view('public.product')
            ->with('product', $product)
            ->with('gallery', $gallery)
            ->with('reviews', $product_reviews)
            ->with('analogs', $product->analogs)
            ->with('product_attributes', $product_attributes));
//            ->with('viewed', $products_viewed))
//            ->withCookie(cookie('viewed', json_encode($viewed)));
    }

    /**
     * Страница поиска
     * @param Product $products
     * @param Request $request
     * @return mixed
     */
    public function search(Product $products, Request $request)
    {
        $search_text = $request->search;
        $current_sort = $request->sort ? $request->sort : 'popularity';

        $products = $products->search($search_text);

        // Пагинация
        $paginator_options = [
            'query' => [
                'sort' => $current_sort
            ]
        ];

        $per_page = config('view.product_quantity');
        $current_page = LengthAwarePaginator::resolveCurrentPage();
        $current_page_products = $products->slice(($current_page - 1) * $per_page, $per_page)->all();
        $products = new LengthAwarePaginator($current_page_products, count($products), $per_page, $current_page, $paginator_options);
        
        return view('public.catalog')
            ->with('products', $products)
            ->with('search', $search_text)
            ->with('current_sort', $current_sort);
    }

    /**
     * Валидация атрибутов товара на одинаковые значения
     * @param $attributes
     * @return bool|string
     */
    public function validate_attributes($attributes) {
        $attributes_error = false;

        if (!empty($attributes)) {
            foreach ($attributes as $product_attribute) {
                $product_attribute_values[] = $product_attribute['value'];
            }

            foreach (array_count_values($product_attribute_values) as $count_value) {
                if ($count_value > 1) {
                    $attributes_error = 'Значения атрибутов не могут быть одинаковы!';
                    break;
                }
            }
        }

        return $attributes_error;
    }

    /**
     * Импорт товаров
     *
     * @param Request $request
     * @param Product $products
     * @return mixed
     */
    public function upload(Request $request, Product $products)
    {
        $update = $request->input('update');
        $errors = false;

        if($request->hasFile('import_file')){
            $errors = [];
            $path = $request->file('import_file')->getRealPath();

            $data = Excel::load($path, function($reader) {

            })->get();

            if(!empty($data) && $data->count()){
                $prepared_data = [];

                foreach ($data as $row) {

                    $row_data = ['tables' => []];
                    foreach ($row as $key => $val){
                        $field = ['options' => $this->get_field_options($key)];

                        // Если данные для этой таблицы ещё не заполнялись
                        if(!isset($row_data['tables'][$field['options']['table']]))
                            $row_data['tables'][$field['options']['table']] = [];

                        // Если поле содержит несколько значений
                        if(isset($field['options']['selector'])){
                            $vals = explode($field['options']['selector'], $val);
                            // Обходим каждое значение отдельно
                            foreach ($vals as $result){
                                $new_row = [];

                                // Доподнительное поле
                                if(isset($field['options']['relations'])){
                                    $relation = preg_replace('/^([^{]+)\{([^}]+)\}/u', '$2', $result);
                                    if($relation != $result) {
                                        $new_row = array_merge($new_row, [$field['options']['relations'] => preg_replace('/^([^{]+)\{([^}]+)\}/u', '$2', $result)]);
                                        $result = trim(preg_replace('/^([^{]+)\{([^}]+)\}/u', '$1', $result));
                                    }
                                }

                                // Делаем необходимые подмены
                                if(isset($field['options']['replace']) && !empty($result)) {
                                    $result = $this->replace_inserted_data($result, $field['options']['replace']['table'], $field['options']['replace']['find'], $field['options']['replace']['replaced']);
                                }

                                $new_row = array_merge($new_row, [$field['options']['field'] => $result]);
                                // Заполняем связанное поле
                                if(isset($field['options']['attached_fields'])){
                                    $new_row = array_merge($new_row, $field['options']['attached_fields']);
                                }

                                // Добавляем данные в общий поток
                                if($result !== ''){
                                    if(isset($field['options']['unique']) && count($new_row) == 1){
                                        if(isset($row_data['tables'][$field['options']['table']][$field['options']['field']]))
                                            $row_data['tables'][$field['options']['table']][$field['options']['field']] = array_merge($row_data['tables'][$field['options']['table']][$field['options']['field']], [$new_row[$field['options']['field']]]);
                                        else
                                            $row_data['tables'][$field['options']['table']][$field['options']['field']] = [$new_row[$field['options']['field']]];
                                    }else{
                                        $row_data['tables'][$field['options']['table']][] = $new_row;
                                    }
                                }
                            }
                        }else{
                            if(isset($field['options']['replace']) && !empty($val)) {
                                $val = $this->replace_inserted_data($val, $field['options']['replace']['table'], $field['options']['replace']['find'], $field['options']['replace']['replaced']);
                            }

                            if(isset($field['options']['unique'])) {
                                $row_data['tables'][$field['options']['table']][$field['options']['field']] = $val;
                            }else {
                                $row_data['tables'][$field['options']['table']][] = [$field['options']['field'] => $val];
                            }
                        }
                    }
                    $prepared_data[] = $row_data;
                }

                $errors = $this->validate_prepared_data($prepared_data);

                if(empty($errors)) {
                    foreach ($prepared_data as $product) {
                        if ($update)
                            $products->update_product($product['tables']);
                        else
                            $products->insert_product($product['tables']);

                        if (isset($product['errors']))
                            $errors[] = $product;
                    }
                }else{
                    return view('admin.products.upload')
                        ->with('errors', $errors);
                }
            }

        }

        return view('admin.products.upload')
            ->with('errors', $errors);
    }

    /**
     * Валидация импортируемых данных
     *
     * @param $prepared_data
     * @return array
     */
    public function validate_prepared_data($prepared_data){
        $products = new Product();
        $names = [];
        foreach ($products->select('name')->get() as $product){
            $names[] = $product->name;
        }
        $errors = [];
        foreach ($prepared_data as $id => $row){

            $err = [];

            if(empty($row['tables']['products']['name'])){
                $err[] = 'Не заполнено название товара.';
            }
            if(in_array($row['tables']['products']['name'], $names)){
                $err[] = 'Дубль названия товара.';
            }
            if(empty($row['tables']['products']['price'])){
                $err[] = 'Не заполнена цена товара.';
            }
            if(empty($row['tables']['products']['price'])){
                $err[] = 'Неизвестное изображение товара.';
            }
            foreach ($row['tables']['products']['gallery'] as $image){
                if(empty($image)){
                    $err[] = 'Неизвестное изображение галлереи.';
                }
            }

            foreach ($row['tables']['unit_products'] as $unit){
                if(empty($unit['unit_id'])){
                    $err[] = 'Неизвестный узел.';
                }
            }

            foreach ($row['tables']['scheme_products'] as $scheme){
                if(empty($scheme['scheme_id'])){
                    $err[] = 'Неизвестная схема.';
                }
            }

            foreach ($row['tables']['product_attributes'] as $attribute){
                if(empty($attribute['attribute_value_id'])){
                    $err[] = 'Неизвестное значение атрибута (id атрибута '.$attribute['attribute_id'].').';
                }
            }

            if(!empty($err)){
                $errors[] = [
                    'id' => $id+1,
                    'errors' => $err
                ];
            }
        }

        return $errors;
    }

    /**
     * Парсинг опций вставки
     *
     * @param $field
     * @return array|bool
     */
    public function get_field_options($field){
        $params = explode('.', $field);
        if(count($params) < 2)
            return false;
        $options = [
            'table' => $params[0],
            'field' => $params[1]
        ];
        $count = count($params);
        if($count > 2){
            for($i=2; $i<$count; $i++){
                if(strpos($params[$i], 'selector') === 0){
                    $options['selector'] = preg_replace('/selector\((.+)\)/', '$1', $params[$i]);
                }elseif(strpos($params[$i], 'attached_field') === 0){
                    if(!isset($options['attached_fields']))
                        $options['attached_fields'] = [];
                    $attached_field = explode(':', preg_replace('/attached_field\((.+)\)/', '$1', $params[$i]), 2);
                    $options['attached_fields'][$attached_field[0]] = $attached_field[1];
                }elseif($params[$i] == 'unique'){
                    $options['unique'] = true;
                }elseif(strpos($params[$i], 'replace') === 0){
                    if(!isset($options['attached_fields']))
                        $options['attached_fields'] = [];
                    $replace = explode(':', preg_replace('/replace\((.+)\)/', '$1', $params[$i]), 3);
                    $options['replace'] = ['table' => $replace[0], 'find' => $replace[1], 'replaced' => $replace[2]];
                }elseif(strpos($params[$i], 'relations') === 0){
                    $options['relations'] = preg_replace('/relations\((.+)\)/', '$1', $params[$i]);
                }
            }
        }

        return $options;
    }

    /**
     * Получение одного поля таблицы по другому
     *
     * @param $data
     * @param $table
     * @param $find
     * @param $replaced
     * @return mixed
     */
    public function replace_inserted_data($data, $table, $find, $replaced){
        $model_name = 'App\Models\\'.str_replace(' ', '', ucwords(str_replace('_', ' ', preg_replace('/s$/', '', $table))));
        if(!class_exists($model_name))
            $model_name = 'App\Models\\'.str_replace(' ', '', ucwords(str_replace('_', ' ', $table)));
        if(!class_exists($model_name) || $data == '')
            return null;

        $table = new $model_name;
        $result = $table->select($replaced)->where($find, '=', $data)->take(1)->get()->first();

        return $result !== null ? $result->$replaced : $result;
    }

    /**
     * Удаление нежелательных символов
     *
     * @param $value
     */
    function trim_value(&$value)
    {
        if(is_string($value)) {
            $value = preg_replace('/(^"|"$|;$|\.$|,$|,\s?,)/', '', preg_replace('@^\s*|\s*$@u', '', $value));
        }
    }

    /**
     * Транслит
     * @param $string
     * @return mixed
     */
    public function rus2lat($string)
    {
        $converter = array(
            'а' => 'a',   'б' => 'b',   'в' => 'v',
            'г' => 'g',   'д' => 'd',   'е' => 'e',
            'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
            'и' => 'i',   'й' => 'y',   'к' => 'k',
            'л' => 'l',   'м' => 'm',   'н' => 'n',
            'о' => 'o',   'п' => 'p',   'р' => 'r',
            'с' => 's',   'т' => 't',   'у' => 'u',
            'ф' => 'f',   'х' => 'h',   'ц' => 'c',
            'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
            'ь' => "",  'ы' => 'y',   'ъ' => "",
            'э' => 'e',   'ю' => 'yu',  'я' => 'ya',

            'А' => 'A',   'Б' => 'B',   'В' => 'V',
            'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
            'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
            'И' => 'I',   'Й' => 'Y',   'К' => 'K',
            'Л' => 'L',   'М' => 'M',   'Н' => 'N',
            'О' => 'O',   'П' => 'P',   'Р' => 'R',
            'С' => 'S',   'Т' => 'T',   'У' => 'U',
            'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
            'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
            'Ь' => "",  'Ы' => 'Y',   'Ъ' => "",
            'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
        );
        return strtr($string, $converter);
    }
}
