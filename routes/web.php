<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\LoginController as LoginController;
use App\Http\Controllers\ProductController as ProductController;
use App\Http\Controllers\CartController as CartController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect(route('products'));
});

Route::get('/login', function () {
    if (Auth::guard('member')->check()) {
        return redirect(route('products'));
    } else {
        return view('login');
    }
})->name('login');

Route::get('/logout', function () {
    Auth::guard('member')->logout();
    return redirect(route('products'));
})->name('logout');

Route::post('/login', [LoginController::class, 'login'])->name('do_login');

Route::get('/products', [ProductController::class, 'getItems'])->name('products');
Route::get('/product/{product_id}', [ProductController::class, 'getItem'])->name('product');

Route::middleware(['auth.member'])->group(function() {
    Route::post('add_cart/{product_id}', [CartController::class, 'addCart'])->name('add_cart');
    Route::post('delete_cart/{cart_id}', [CartController::class, 'deleteCart'])->name('delete_cart');
    Route::get('/cart', [CartController::class, 'getItems'])->name('cart');
});
