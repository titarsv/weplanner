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

    /**
     * Каталог
     *
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function all_categories(User $user){
        return view('public.catalog', [
            'partition' => 'home',
            'popular' => $user->get_popular_contractors(),
            'providers' => $user->get_new_contractors()
        ]);
    }

    /**
     * Категория
     *
     * @param $slug
     * @param Request $request
     * @param Category $categories
     * @return $this
     */
    public function show($slug, Request $request, Category $categories)
    {
        if(!empty($request->category)) {
            $category = $categories->where('id', $request->category)->first();
            if(!is_null($category) && $category->slug != $slug){
                //return redirect("catalog/$category->slug")->with('request', $request);
                return redirect()->route("category", ['slug' => $category->slug, 'city' => $request->city, 'event' => $request->event]);
            }
        }else{
            $category = $categories->where('slug', $slug)->first();
        }

        if (is_null($category))
            abort(404);

        $filters = [];

        if(isset($request->city))
            $filters[] = ['users_data.city', $request->city];

        $sort_array = [
            'sort_rating',
            'sort_name',
            'sort_reviews',
            'sort_price'
        ];

        $current_sort = $request->sort ? $request->sort : 'sort_rating';

        $contractors = $category->searchContractors($filters, $current_sort);

        return view('public.category', [
            'category' => $category,
            'contractors' => $contractors,
            'sort_array' =>  $sort_array,
            'current_sort' => $current_sort,
            'slug' => $slug,
            'services' => $category->services,
            'city_id' => $request->city
        ]);
    }
}
