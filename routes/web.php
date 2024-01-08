<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Dashboard Route (with email verification middleware)
Route::get('dashboard', [ItemController::class, 'index'])
    ->name('dashboard')
    ->middleware(['auth', 'verified']);
    
//EMAIL VERIFICATION
Auth::routes(['verify' => true]);
Route::get('/verify-email/{token}', [CustomAuthController::class, 'verifyEmail'])->name('verify.email');


//LOGIN/REGISTER ROUTES
Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom');
Route::get('register', [CustomAuthController::class, 'registration'])->name('register');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom');
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');
////

//CART ROUTE
Route::post('add-to-cart/{id}', [CartController::class, 'addToCart'])->name('addToCart');
Route::get('cart', [CartController::class, 'showCart'])->name('cart');
Route::get('checkout', [CartController::class, 'checkout'])->name('checkout');
Route::delete('/remove-item/{id}', [CartController::class, 'removeItem'])->name('removeItem');


//SEARCH ROUTE
// Define the route for the search functionality
Route::get('/search', [ItemController::class, 'search'])->name('search');

// ORDER ROUTES
Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');
Route::get('/user/orders', [OrderController::class, 'userOrders'])->name('user.orders');

