<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Address;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ConfirmCheckoutController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('name', 'asc')->get();
    
        $user = Auth::user();
        $order = Order::where('user_id', $user->id)->where('statut', 0)->first();
    
        $selectedAddress = $order->orderAddress; // Récupérer l'objet OrderAddress associé à la commande
        $selectedCarrier = $order->orderCarrier; // Récupérer l'objet OrderCarrier associé à la commande
    
        // Rediriger vers une page de confirmation ou toute autre action appropriée
        return Redirect::route('stripe', [
            'reference' => $order->reference,
            'categories' => $categories,
            'selectedAddress' => $selectedAddress,
            'selectedCarrier' => $selectedCarrier,
        ]);
    }
}
