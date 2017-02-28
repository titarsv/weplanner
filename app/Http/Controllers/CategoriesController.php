<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;
use App\Http\Requests;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Session;
use Validator;


class CategoriesController extends Controller
{

    private $rules = [
        'name' => 'required',
        'meta_title' => 'required|max:75',
        'meta_description' => 'max:180',
        'meta_keywords' => 'max:180',
        'url_alias' => 'required|unique:categories',
    ];

    private $messages = [
        'name.required' => 'Поле должно быть заполнено!',
        'meta_title.required' => 'Поле должно быть заполнено!',
        'meta_title.max' => 'Максимальная длина заголовка не может превышать 75 символов!',
        'meta_description.max' => 'Максимальная длина описания не может превышать 180 символов!',
        'meta_keywords.max' => 'Максимальная длина ключевых слов не может превышать 180 символов!',
        'url_alias.required' => 'Поле должно быть заполнено!',
        'url_alias.unique' => 'Значение должно быть уникальным для каждой категории!'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::where('parent_id', 0)->with('children')->paginate(15);

        return view('admin.categories.index', ['categories' => $categories]);
    }

    public function load(Request $request, Category $category){

        $categories = Category::where('parent_id', $request->parent_id)->get();

        return view('admin.layouts.category', [
            'categories' => Category::where('parent_id', $request->parent_id)->get(),
            'childs' => true
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create', [
            'categories' => Category::all(),
            'attributes' => Attribute::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Category $category)
    {

        $validator = Validator::make($request->all(), $this->rules, $this->messages);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->with('message-error', 'Сохранение не удалось! Проверьте форму на ошибки!')
                ->withErrors($validator);
        }

        $category->fill($request->except('_token'));
        $category->description = !empty($request->description) ? $request->description : null;
        $category->sort_order = !empty($request->sort_order) ? $request->sort_order : 0;
        $category->save();

        return redirect('/admin/categories')
            ->with('message-success', 'Категория ' . $category->name . ' успешно добавлена.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.categories.edit', [
            'attributes'    => Attribute::all(),
            'category'      => Category::find($id),
            'categories'    => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $rules = $this->rules;
        $rules['url_alias'] = 'required|unique:categories,url_alias,'.$id;

        $validator = Validator::make($request->all(), $rules, $this->messages);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->with('message-error', 'Сохранение не удалось! Проверьте форму на ошибки!')
                ->withErrors($validator);
        }

        $category = Category::find($id);
        $category->fill($request->except('_token'));
        $category->description = !empty($request->description) ? $request->description : null;
        $category->sort_order = !empty($request->sort_order) ? $request->sort_order : 0;
        $category->save();

        return redirect('/admin/categories')
            ->with('message-success', 'Категория ' . $category->name . ' успешно обновлена.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();

        return redirect('/admin/categories')
            ->with('message-success', 'Категория ' . $category->name . ' успешно удалена.');
    }

    public function all_categories(User $user){
        return view('public.catalog', [
            'partition' => 'home',
            'popular' => $user->get_popular_contractors(),
            'providers' => $user->get_new_contractors()
        ]);
    }

    /**
     * Каталог товаров
     *
     * @param $alias
     * @param Request $request
     * @param Category $categories
     * @param Product $product
     * @return $this
     */
    public function show($alias, Request $request, Category $categories, Product $product, Unit $unit)
    {
        $per_page = config('view.product_quantity');

        $sort_array = [
            [
                'value' => 'popularity',
                'name' => 'популярности'
            ],
            [
                'value' => 'date',
                'name' => 'дате'
            ],
            [
                'value' => 'name',
                'name' => 'названию'
            ]
        ];

        $current_sort = $request->sort ? $request->sort : 'popularity';

        $category = $categories->where('url_alias', $alias)->first();
        if (is_null($category))
            abort(404);

        $current_brand = null;
        $models = null;
        $current_model = null;
        $units = null;

        if($category->parent_id == 0){
            $current_category = $category;
            $current_cat = $current_category;
            $children_categories = $current_category->children_ids();
        }else{
            $parent_categories = array_reverse($category->get_parent_categories());
            $current_category = $parent_categories[0];
            $current_brand = $parent_categories[1];
            $models = $current_brand->children;
            if(isset($parent_categories[2])){
                $current_model = $parent_categories[2];
                $current_cat = $current_model;
                $units = $current_model->units;
                $children_categories = [$current_model->id];
            }else {
                $current_cat = end($parent_categories);
                $children_categories = $current_cat->children_ids();
            }
        }

        $brands = $current_category->children;

        $products = $product->getProductsByCategory($children_categories, $current_sort);

        // Пагинация
        $paginator_options = [
            'path'  => '/catalog/' . $alias,
            'query' => [
                'sort' => $current_sort
            ]
        ];

        $current_page = LengthAwarePaginator::resolveCurrentPage();
        $current_page_products = $products->slice(($current_page - 1) * $per_page, $per_page)->all();
        $products = new LengthAwarePaginator($current_page_products, count($products), $per_page, $current_page, $paginator_options);

//        $viewed = json_decode($request->cookie('viewed'), true);
//
//        if(!is_null($viewed)) {
//            $viewed = $product->getProducts($viewed);
//        }

        if($request->json !== null) {
//            return response()->json([
//                'current_page' => $products->currentPage(),
//                'pages_count' => $products->lastPage(),
//                'products' => view('public.layouts.products')->with('products', $products)
//            ]);
            return view('public.layouts.products')->with('products', $products);
        }

        return view('public.catalog')
            ->with('category', $current_category)
            ->with('brands', $brands)
            ->with('current_brand', $current_brand)
            ->with('models', $models)
            ->with('current_model', $current_model)
            ->with('products', $products)
            ->with('sort_array', $sort_array)
            ->with('current_sort', $current_sort)
            ->with('units', $units)
            //->with('viewed', $viewed)
            ->with('alias', $alias)
            ->with('current_cat', $current_cat);
    }
}
