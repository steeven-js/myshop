<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Category;
use App\Models\OrderDetail;
use App\Models\OrderAddress;
use App\Models\OrderCarrier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

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

        return view('order', compact('categories', 'orders'));
    }

    /**
     * Store a newly created resource in storage.
     */
    /**
     * Show the details of a specific order.
     */
    public function show($reference)
    {
        $categories = Category::orderBy('name', 'asc')->get();
        $order = Order::where('reference', $reference)->first();

        $selectedAddress = OrderAddress::where('order_id', $order->id)->first();
        $selectedCarrier = OrderCarrier::where('order_id', $order->id)->first();

        // Récupérer les détails de la commande spécifique
        $orderDetails = $order->orderDetails;

        $product_image = DB::table('order_details')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->where('order_details.order_id', $order->id)
            ->select('products.image')
            ->get();

        // dd($product_image);

        return view('order_detail', compact('categories', 'order', 'orderDetails', 'selectedAddress', 'selectedCarrier', 'product_image'));
    }
}
