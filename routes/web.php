<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\OrderCancelController;
use App\Http\Controllers\OrderSuccessController;
use App\Http\Controllers\ConfirmCheckoutController;

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


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/addtocart/{product}', [CartController::class, 'addToCart'])->name('addtocart'); //Ne peut ajouter dans le panier que les utilisateurs connectés
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::get('/cart/moins/{product}', [CartController::class, 'decrementCartItem'])->name('decrementCartItem');
    Route::get('/cart/plus/{product}', [CartController::class, 'incrementCartItem'])->name('incrementCartItem');
    Route::get('/cart/del/{product}', [CartController::class, 'delete'])->name('cart.delete');
    Route::get('/cart/destroy/', [CartController::class, 'clearCart'])->name('cart.destroy');

    Route::get('/commande', [OrderController::class, 'add'])->name('order.recap');
    Route::post('/commande', [OrderController::class, 'store'])->name('order.recap.store');

    Route::get('/commande/chekout', [CheckoutController::class, 'checkout'])->name('checkout');

    Route::get('/commande/create-session/{reference}', [StripeController::class, 'stripe_create_session'])->name('stripe');

    Route::get('/commande/merci/{checkout_session_id}', [OrderSuccessController::class, 'index'])->name('order_success');
    Route::get('commande/erreur/{checkout_session_id}', [OrderCancelController::class, 'index'])->name('order_cancel');

    Route::get('/account', [AccountController::class, 'index'])->name('account');

    Route::get('/account/address', [AddressController::class, 'index'])->name('address');

    // Ajouter des adresses
    Route::get('/account/address/add', [AddressController::class, 'formAdd'])->name('address.add');
    Route::post('/account/address/add', [AddressController::class, 'add'])->name('address.add');

    // Modifier des adresses
    Route::get('/account/address/edit/{id}', [AddressController::class, 'formEdit'])->name('address.edit');
    Route::post('/account/address/edit/{id}', [AddressController::class, 'edit'])->name('address.edit');

    // Supprimer une adresse
    Route::get('/account/address/del/{id}', [AddressController::class, 'delete'])->name('address.delete');

    Route::get('/account/commande', [OrderController::class, 'index'])->name('order');
    Route::get('/account/commande/{reference}', [OrderController::class, 'show'])->name('order.detail');
});

require __DIR__ . '/auth.php';

// Route pour lister les produits
Route::get('/', [ProductController::class, 'index'])->name('home');

// Route pour filtrer les categories
Route::get('/filtre/{category}', [ProductController::class, 'index'])->name('home.filtre');

// Route pour afficher le détail de chaques produits
Route::get('/detail/{product}', [ProductController::class, 'detail'])->name('home.detail');
