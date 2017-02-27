<?php

namespace App\Http\Controllers;

use App\Models\User;

class MainController extends Controller
{
    public function index(User $user)
    {
         return view('index', [
            'partition' => 'home',
            'popular' => $user->get_popular_contractors(),
            'providers' => $user->get_new_contractors()
        ]);
    }
}
