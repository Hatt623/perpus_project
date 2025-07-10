<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\Admin;

use App\Http\Controllers\BackendController;
use App\Http\Controllers\Backend\GenreController;
use App\Http\Controllers\Backend\BookController;

use App\Http\Controllers\FrontendController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Backend\OrderController as BackendOrderController;
use App\Http\Controllers\LendingController;
use App\Http\Controllers\ReturnsController;
use App\Http\Controllers\Backend\ReturnsController as BackendReturnsController;



    //Member/Guest 
Route::get('/',[FrontendController::class, 'index']);

Route::get('/book', [FrontendController::class,'book'])->name('book.index');
Route::get('/book/{book}', [FrontendController::class,'singleBook'])->name('book.show');
Route::get('/book/genre/{slug}', [FrontendController::class,'filterByCategory'])->name('book.filter');
Route::get('/search', [FrontendController::class,'search'])->name('book.search');

    // Cart
Route::get('/cart', [CartController::class,'index'])->name('cart.index');
Route::post('/add-to-cart/{book}', [CartController::class, 'addToCart'])->name('cart.add');
Route::put('/cart/update/{id}', [CartController::class,'updateCart'])->name('cart.update');
Route::delete('/cart/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

    //Lendings
Route::get('/lending', [LendingController::class, 'index'])->name('lending.index'); 
Route::post('/add-to-lending/{book}', [LendingController::class, 'addToLending'])->name('lending.add');
Route::put('/lending/update/{id}', [LendingController::class,'updateLending'])->name('lending.update');
Route::delete('/lending/{id}', [LendingController::class, 'remove'])->name('lending.remove');
Route::get('/lend', [LendingController::class, 'lend'])->name('lending.lend');

    //orders
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::get('/orders/{id}/', [OrderController::class, 'show'])->name('orders.show');

    // Returns
Route::get('/return', [ReturnsController::class, 'index'])->name('return.index');
Route::get('/return/{id}/', [ReturnsController::class, 'show'])->name('return.show');

Auth::routes();

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
});

Route::group(['prefix' => 'admin', 'as' => 'backend.', 'middleware' => ['auth', Admin::class]], function ()
{
   Route::get('/', [BackendController::class,'index']); 

    // Crud
    Route::resource('/genre', GenreController::class);
    Route::resource('/book', BookController::class);
    Route::resource('/orders', BackendOrderController::class);
    Route::put('/orders/{id}/status', [BackendOrderController::class, 'updateStatus'])->name('orders.updateStatus');
    Route::resource('/returns', BackendReturnsController::class);
    Route::put('/returns/{id}/status', [BackendReturnsController::class, 'updateStatus'])->name('returns.updateStatus');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/', function () {
//     return view('welcome');
// });
