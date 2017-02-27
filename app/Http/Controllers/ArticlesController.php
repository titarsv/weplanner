<?php

namespace App\Http\Controllers;

use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use App\Models\Article;
use App\Models\User;
use App\Models\Settings;
use App\Models\Image;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;


class ArticlesController extends Controller
{
    public $articles;
    public $users;
    public $settings;
    public $images;
    public $curent_user;

    protected $rules = [
        'title' => 'required|unique:articles',
        'text' => 'required',
        'url_alias' => 'required|unique:articles',
        'image_id' => 'required',
    ];

    protected $messages = [
        'title.required' => 'Поле должно быть заполнено!',
        'title.unique' => 'Поле должно быть уникальным!',
        'text.required' => 'Поле должно быть заполнено!',
        'url_alias.required' => 'Поле должно быть заполнено!',
        'url_alias.unique' => 'Поле должно быть уникальным!',
        'image_id.required' => 'Поле должно быть заполнено!',
    ];

    protected $user;

    public function __construct()
    {
        $this->user = Sentinel::getUser();
    }

    public function index()
    {
        return view('admin.articles.index', [
            'articles'  => Article::orderBy('updated_at', 'desc')->paginate(10)
        ]);
    }

    public function create()
    {
        return view('admin.articles.create');
    }
    public function store(Request $request, Article $articles)
    {
        $rules = $this->rules;
        $messages = $this->messages;

        $validator = Validator::make($request->all(), $rules, $messages);
        $image_id = $request->image_id ? $request->image_id : 1;
        $href = Image::find($image_id)->href;

        $user_id = $this->user->id;
        $request->merge(['href' => $href, 'user_id' => $user_id]);

        if($validator->fails()){
            return redirect()
                ->back()
                ->withInput()
                ->with('message-error', 'Сохранение не удалось! Проверьте форму на ошибки!')
                ->withErrors($validator);
        }

        $request = $request->only([
            'user_id',
            'url_alias',
            'title',
            'published',
            'text',
            'image_id',
            'meta_title',
            'meta_keywords',
            'meta_description'
        ]);

        $articles->fill($request);
        $articles->text = htmlentities($request['text']);
        $articles->save();

        return redirect('/admin/articles')
            ->with('message-success', 'Статья ' . $articles->title . ' успешно добавлена.');
    }

    public function edit($id)
    {
        $article = Article::find($id);

        $products = $products = Cache::tags('products')->remember('all_products', 120, function() {
            return Product::all();
        });

        $products_ids = [];
        foreach($article->products as $product){
            $products_ids[] = $product->id;
        }

        return view('admin.articles.edit')
            ->with('article', $article)
            ->with('products', $products)
            ->with('products_ids', $products_ids);
    }

    public function update($id, Request $request)
    {
        $rules = $this->rules;
        $rules['title'] = 'required|unique:articles,title,'.$id.'';
        $rules['url_alias'] = 'required|unique:articles,url_alias,'.$id;

        $validator = Validator::make($request->all(), $rules, $this->messages);

        $article = Article::find($id);
        $image_id = $request->image_id ? $request->image_id : $article->image_id;
        $href = Image::find($image_id)->href;

        $user_id = $this->user->id;
        $request->merge(['href' => $href, 'user_id' => $user_id]);

        if($validator->fails()){
            return redirect()
                ->back()
                ->withInput()
                ->with('message-error', 'Сохранение не удалось! Проверьте форму на ошибки!')
                ->withErrors($validator);
        }

        $request = $request->only([
            'user_id',
            'url_alias',
            'title',
            'subtitle',
            'published',
            'text',
            'image_id',
            'meta_title',
            'meta_keywords',
            'meta_description',
            'products'
        ]);

        $request['text'] = htmlentities($request['text']);

        //$article->where('id', $id)->update($request);

        $article->fill($request);

        if(empty($request['products'])){
            $article->products = [];
        }

        $article->push();

        return redirect('/admin/articles')
            ->with('message-success', 'Статья ' . $article->title . ' успешно обновлена.');
    }

    public function destroy($id)
    {
        $article = Article::find($id);
        $article->delete();

        return redirect('/admin/articles')
            ->with('message-success', 'Статья ' . $article->title . ' успешно удалена.');
    }

    /**
     * Статья
     *
     * @param $alias
     * @return mixed
     */
    public function show($alias)
    {
        $article = Article::where('url_alias', $alias)->first();
        if (is_null($article))
            abort(404);

        setlocale(LC_TIME, 'RU');
        $article->date = iconv("cp1251", "UTF-8", $article->updated_at->formatLocalized('%d.%m.%Y'));

        $article->increment('visits');

        return view('public.news_item', [
            'article'   => $article,
            'similar'   => Article::where('published', 1)->orderBy('visits', 'desc')->where('id', '<>', $article->id)->offset(2)->take(3)->get(),
            'products'   => $article->products
        ]);
    }

    /**
     * Каталог статей
     *
     * @param Request $request
     * @param Article $article
     * @return $this
     */
    public function showAll(Request $request, Article $article)
    {
        $articles = $article->where('published', 1)->orderBy('updated_at', 'desc');

        if(!empty($request->search)){
            $articles->where('title', 'like', '%'.$request->search.'%');
        }

        setlocale(LC_TIME, 'RU');

        if(!is_null($articles)) {
            foreach ($articles as $key => $article) {
                $articles[$key]->date = iconv("cp1251", "UTF-8", $articles[$key]->updated_at->formatLocalized('%d.%m.%Y'));
            }
        }

        return view('public.news', [
            'articles' => $articles->get(),
            'search' => $request->search
        ]);
    }
}
