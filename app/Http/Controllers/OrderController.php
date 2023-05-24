<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Category;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categories = Category::OrderBy('name', 'asc')->get(); // liste de mes catégories

        $orders = Order::orderBy('created_at', 'desc')->get();

        // dd($orders);

        return view('Commande', compact('categories', 'orders'));
    }

    /**
     * Store a newly created resource in storage.
     */
    /**
     * Show the details of a specific order.
     */
    public function show(Order $order)
    {
        $categories = Category::OrderBy('name', 'asc')->get(); // liste de mes catégories



        // Récupérer les détails de la commande spécifique
        $orderDetails = $order->orderDetails;

        // dd($orderDetails);

        // Passer les détails de la commande à la vue
        return view('CommandeDetail', compact('categories', 'order', 'orderDetails'));
    }
}
