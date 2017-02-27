<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Product;
use App\Models\Category;
use App\Models\Article;
use App\Models\Unit;

class XMLSitemap extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'xmlsitemap'; //название нашей команды

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generation Sitemap.xml';//описание нашей команды

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        //тут тело как-раз нашей функции
        $site_url = env('APP_URL');//уберите лишние пробелы
        $base = '<?xml version="1.0" encoding="UTF-8"?>
            <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
            </urlset>';
        $xmlbase = new \SimpleXMLElement($base);
        $row  = $xmlbase->addChild("url");
        $row->addChild("loc",$site_url);
        $row->addChild("lastmod",date("c"));
        $row->addChild("changefreq","monthly");
        $row->addChild("priority","1");

        $row  = $xmlbase->addChild("url");
        $row->addChild("loc",$site_url.'/news');
        $row->addChild("lastmod",date("c"));
        $row->addChild("changefreq","monthly");
        $row->addChild("priority","1");

        $row  = $xmlbase->addChild("url");
        $row->addChild("loc",$site_url.'/sale');
        $row->addChild("lastmod",date("c"));
        $row->addChild("changefreq","monthly");
        $row->addChild("priority","1");

        $row  = $xmlbase->addChild("url");
        $row->addChild("loc",$site_url.'/about');
        $row->addChild("lastmod",date("c"));
        $row->addChild("changefreq","monthly");
        $row->addChild("priority","1");

        $row  = $xmlbase->addChild("url");
        $row->addChild("loc",$site_url.'/contacts');
        $row->addChild("lastmod",date("c"));
        $row->addChild("changefreq","monthly");
        $row->addChild("priority","1");

        //выбираем нужные нам записи из базы данных
        foreach (Product::where('stock', 1)->get() as $result) {
            $row  = $xmlbase->addChild("url");
            $row->addChild("loc",$site_url.$result->url);
            $row->addChild("lastmod",$result->created_at->format("Y-m-d\TH:i:sP"));
            $row->addChild("changefreq","monthly");
            $row->addChild("priority","1");
        }
        foreach (Category::where('status', 1)->get() as $result) {
            $row  = $xmlbase->addChild("url");
            $row->addChild("loc",$site_url.$result->url);
            $row->addChild("lastmod",$result->created_at->format("Y-m-d\TH:i:sP"));
            $row->addChild("changefreq","monthly");
            $row->addChild("priority","1");
        }
        $category = new Category();
        foreach ($category->level(2)->groupBy('name') as $brand => $categories) {
            $row  = $xmlbase->addChild("url");
            $row->addChild("loc",$site_url.'/brand/'.$brand);
            $row->addChild("lastmod",date("c"));
            $row->addChild("changefreq","monthly");
            $row->addChild("priority","1");
        }
        foreach (Article::where('published', 1)->get() as $result) {
            $row  = $xmlbase->addChild("url");
            $row->addChild("loc",$site_url.$result->url);
            $row->addChild("lastmod",$result->created_at->format("Y-m-d\TH:i:sP"));
            $row->addChild("changefreq","monthly");
            $row->addChild("priority","1");
        }
        foreach (Unit::where('status', 1)->get() as $result) {
            $row  = $xmlbase->addChild("url");
            $row->addChild("loc",$site_url.$result->url);
            $row->addChild("lastmod",$result->created_at->format("Y-m-d\TH:i:sP"));
            $row->addChild("changefreq","monthly");
            $row->addChild("priority","1");
        }

        //укажите путь куда нужно сохранять файл
        $xmlbase->saveXML(public_path()."/sitemap.xml");
    }
}
