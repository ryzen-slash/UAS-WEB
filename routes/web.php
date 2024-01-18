<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

use App\Models\Product;
use App\Models\Cart;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [CustomerController::class, 'index']);

Route::middleware('guest.customers')->group(function () {
    Route::get('/login', function () {
        return view('login');
    });

    Route::post('/register', [CustomerController::class, 'register']);
    Route::post('/login',    [CustomerController::class, 'login']);
});


Route::middleware('customers')->group(function () {

    Route::post('/cart/new/{id}', [CartController::class, 'new']);
    Route::get('/logout',    [CustomerController::class, 'logout']);

    Route::post('/order', [OrderController::class, 'new']);

});

Route::middleware('guest')->group(function() {
    Route::get('/admin/login', function () {
        return view('dashboard.login');
    })->name('login');

    Route::post('/admin/login',    [UsersController::class, 'login']);
});

Route::middleware('auth')->group(function() {

    Route::get('/dashboard', function () {
        return redirect('/dashboard/orders');
    });

    Route::get('/dashboard/orders', [OrderController::class, 'index']);

    Route::get('/dashboard/foods', function () {
        return view('dashboard.foods', ['foods' => Product::all()]);
    });

    Route::get('/dashboard/foods/new', function () {
        return view('dashboard.new-food');
    });

    Route::get('/dashboard/foods/edit/{id}', function ($id) {
        return view('dashboard.edit-food', ['food' => Product::find($id)]);
    });

    Route::post('/dashboard/foods/new',      [ProductController::class, 'create']);
    Route::put('/dashboard/foods/edit/{id}', [ProductController::class, 'update']);
    Route::delete('/dashboard/foods/{id}',   [ProductController::class, 'delete']);

    Route::put('/orders/accept/{id}', [OrderController::class, 'accept']);

    Route::get('/admin/logout', [UsersController::class, 'logout']);

});
