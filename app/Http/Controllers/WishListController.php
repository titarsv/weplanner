<?php

namespace App\Http\Controllers;

use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Wishlist;

class WishListController extends Controller
{
    public function update(Request $request, Wishlist $wishlist)
    {
        $user = Sentinel::check();

        if(!$user){
            return response()->json(['error' => 'unregistered']);
        }

        if($request->action == 'add'){
            $count = $wishlist->addToWishlist((int)$request->product_id, $user->id);
            return response()->json([
                'count' => $count,
                'action' => 'add'
            ]);
        }

        if($request->action == 'remove'){
            $count = $wishlist->removeFromWishlist((int)$request->product_id, $user->id);
            return response()->json([
                'count' => $count,
                'action' => 'remove'
            ]);
        }
    }
}
