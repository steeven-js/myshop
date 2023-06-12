<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderCancelController extends Controller
{
    public function index($stripe_id)
    {
        $categories = Category::orderBy('name', 'asc')->get(); // Retrieve categories

        $order = Order::where('stripe_id', $stripe_id)->where('statut', 0)->first();

        if ($order && $order->statut === 0) {
            // Set the order's status to 1 (cancelled)
            $order->statut = 1;

            // Supprimer les éléments du panier de l'utilisateur
            Cart::where('user_id', Auth::user()->id)->delete();
            
            $order->save();
        }
        return view('order_cancel', compact('categories', 'order'));
    }
}
