<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;

class OrderController extends Controller
{
    public function index() {
        $orders = DB::table('orders')
                    ->select(
                            'orders.id',
                            'orders.qty',
                            'orders.total_price',
                            'products.name AS product_name',
                            'products.price',
                            'products.img',
                            'customers.name',
                            'customers.address'
                        )
                    ->leftJoin('products', 'orders.product_id', '=', 'products.id')
                    ->leftJoin('customers', 'orders.customer_id', '=', 'customers.id')
                    ->where('orders.status', '=', 'processing')
                    ->get();

        //dd($orders);

        return view('dashboard.orders', ['orders' => $orders]);
    }

    public function new(Request $request) {
        $validated = $request->validate([
                'cart_id'    => 'required',
                'product_id' => 'required',
                'qty'        => 'required',
            ]);

        $total_price = Product::find($request->product_id)->price * $request->qty;

        //dd($request);

        Order::create([
                'product_id'  => $request->product_id,
                'customer_id' => Auth::guard('customers')->user()->id,
                'qty'         => $request->qty,
                'total_price' => $total_price,
                'status'      => 'processing',
            ]);

        Cart::find($request->cart_id)->delete();

        return redirect('/#menu');
    }

    public function accept($id) {
        Order::find($id)
             ->update(['status' => 'finished']);

        return redirect('/dashboard/orders');
    }
}
