<?php

namespace App\Http\Controllers;

use App\Models\User;

class MainController extends Controller
{
    public function index()
    {
        $user = User::where('id', 1)->first();

        //dd($user->categories[0]->users);

        return view('index', [
            'partition' => 'home',
            'popular' => [],
            'providers' => [],
        ]);
    }

}
