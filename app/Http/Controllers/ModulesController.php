<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Product;
use Request;
use App\Http\Requests;
use App\Models\Module;

class ModulesController extends Controller
{

    public function index(Module $modules)
    {
        return view('admin.modules.index')
            ->with('modules', $modules->all());
    }

    public function getModule($alias)
    {
        $module = Module::where('alias_name', $alias)->first();
        $settings = json_decode($module->settings);

        $products = [];
        if(!empty($settings->products)) {
            $product = new Product;
            $products = $product->getProducts($settings->products);
        }

        return view('admin.modules.' . $alias, [
            'module' => $module,
            'settings' => $settings,
            'products' => $products,
            'image'    => new Image,
        ]);
    }

    public function setModule($alias)
    {
        $module = Module::where('alias_name', $alias)->first();
        $module->set(Request::except('_token'));

        return redirect('/admin/modules')
            ->with('message-success', 'Настройки модуля ' . $module->name . ' успешно обновлены!');
    }

}
