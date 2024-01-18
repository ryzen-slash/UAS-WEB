<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Cart;

class CartController extends Controller
{
    public function new($id) {
        Cart::create([
            "product_id"  => $id,
            "customer_id" => Auth::guard('customers')->user()->id,
            "qty"         => 1,
        ]);

        return redirect('/#menu');
    }
}
