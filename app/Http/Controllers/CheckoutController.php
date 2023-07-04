<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderDetail;
use App\Models\OrderAddress;
use App\Models\OrderCarrier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CheckoutController extends Controller
{
    public function checkout()
    {
        $categories = Category::orderBy('name', 'asc')->get(); // liste de mes catégories

        $user = Auth::user();
        $order = Order::where('user_id', $user->id)->where('statut', 0)->first();

        // Récupérer les détails de la commande
        $orderDetails = OrderDetail::where('order_id', $order->id)
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('order_details.*', 'products.name as product_name', 'categories.name as category_name')
            ->get();

        // Récupérer l'adresse de livraison
        $shippingAddress = OrderAddress::where('order_id', $order->id)->first();

        // Récupérer le transporteur
        $carrier = OrderCarrier::where('order_id', $order->id)->first();

        return view('recap', [
            'categories' => $categories,
            'order' => $order,
            'orderDetails' => $orderDetails,
            'shippingAddress' => $shippingAddress,
            'carrier' => $carrier,
        ]);
    }


}
