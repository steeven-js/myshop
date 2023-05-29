<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class OrderSuccessController extends Controller
{
    //
    public function index($stripe_id)
    {
        $categories = Category::OrderBy('name', 'asc')->get(); // liste de mes catégories

        $order = Order::where('stripe_id', $stripe_id)->first();

        // dd($order);

        if ($order->statut === 0) {

            $order->statut = 1;

            // Supprimer les éléments du panier de l'utilisateur
            Cart::where('user_id', Auth::user()->id)->delete();

            $order->save();
        }

        // dd($order->orderDetails);

        return view('order_success', compact('categories', 'order'));
    }

    public function show($reference)
    {
        $categories = Category::OrderBy('name', 'asc')->get(); // liste de mes catégories

        $order = Order::where('reference', $reference)->first();

        $orderDetails = $order->orderDetails;

        // dd($order);

        return view('order_detail', compact('categories', 'order', 'orderDetails'));
    }
}