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

        // Mettre à jour le statut de la commande à 1
        $order->statut = 1;

        if ($order->statut === 1) {
            // Supprimer les éléments du panier de l'utilisateur
            Cart::where('user_id', Auth::user()->id)->delete();
        } else {
            // Supprimer la commande et ses détails de commande associés
            $order->cleanOrder();
        }

        // Enregistrer les modifications de la commande
        $order->save();

        // Nettoyer les autres commandes avec un statut de 0
        $ordersClean = Order::where('statut', 0)->get();

        foreach ($ordersClean as $orderClean) {
            $orderClean->cleanOrder();
        }

        $selectedAddress = $order->orderAddress; // Récupérer l'objet OrderAddress associé à la commande
        $selectedCarrier = $order->orderCarrier; // Récupérer l'objet OrderCarrier associé à la commande

        // Retourner la vue d'ordre réussi avec les catégories et la commande
        return view('order_success', compact('categories', 'order', 'selectedAddress', 'selectedCarrier'));
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
