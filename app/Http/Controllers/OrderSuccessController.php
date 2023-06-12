<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class OrderSuccessController extends Controller
{
    public function index($stripe_id)
    {
        $categories = Category::orderBy('name', 'asc')->get(); // liste de mes catégories

        $order = Order::where('stripe_id', $stripe_id)->first();

        if ($order && $order->statut === 0) {
            // Mettre à jour le statut de la commande à 2 (validée par Stripe)
            $order->statut = 2;

            // Supprimer les éléments du panier de l'utilisateur
            Cart::where('user_id', Auth::user()->id)->delete();

            // Enregistrer les modifications de la commande
            $order->save();

            $selectedAddress = $order->orderAddress; // Récupérer l'objet OrderAddress associé à la commande
            $selectedCarrier = $order->orderCarrier; // Récupérer l'objet OrderCarrier associé à la commande

            // Retourner la vue d'ordre réussi avec les catégories et la commande
            return view('order_success', compact('categories', 'order', 'selectedAddress', 'selectedCarrier'));
        }

        return redirect()->route('home')->with('error', 'Commande non trouvée ou déjà validée.');
    }

    public function show($reference)
    {
        $categories = Category::orderBy('name', 'asc')->get(); // liste de mes catégories

        $order = Order::where('reference', $reference)->first();

        if ($order) {
            $orderDetails = $order->orderDetails;

            return view('order_detail', compact('categories', 'order', 'orderDetails'));
        }

        return redirect()->route('home')->with('error', 'Commande non trouvée.');
    }
}
