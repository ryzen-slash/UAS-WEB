<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Cart;


class CustomerController extends Controller
{
    public function register(Request $request) {
        $validated = $request->validate([
                'name'     => 'required',
                'email'    => 'required|email',
                'address'  => 'required',
                'password' => 'required|min:8',
            ]);

        $validated['password'] = Hash::make($request->password);

        Customer::create($validated);

        return redirect('/login');
    }

    public function login(Request $request) {
        $validated = $request->validate([
                'email'    => 'required|email',
                'password' => 'required|min:8',
            ]);

        if(Auth::guard('customers')->attempt($validated)) {
            return redirect('/');
        }

        return redirect()->back();

    }

    public function index() {

        $carts = [];

        if (Auth::guard('customers')->check()) {
            //$carts = Cart::where('customer_id', '=', Auth::guard('customers')->user()->id)->get();
            $carts = DB::table('carts')
                       ->select(
                        'carts.id',
                        'carts.product_id',
                        'carts.qty',
                        'products.name',
                        'products.img',
                        'products.price'
                       )
                       ->where('customer_id', '=', Auth::guard('customers')->user()->id)
                       ->leftJoin('products', 'carts.product_id', '=', 'products.id')
                       ->get();
        }

        //dd($carts);

        return view('home', ['foods' => Product::all(), 'carts_item' => $carts]);
    }

    public function logout(Request $request) {
        Auth::guard('customers')->logout();
        $request->session()->regenerateToken();
        $request->session()->invalidate();

        return redirect('/');
    }
}
