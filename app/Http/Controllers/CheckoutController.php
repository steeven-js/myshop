<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function checkout()
    {
        $categories = Category::OrderBy('name', 'asc')->get(); // liste de mes catégories

        // Récupérer le panier de l'utilisateur
        $cartItems = Cart::where('user_id', Auth::user()->id)->get();

        // Calculer la somme du panier
        $total = 0;
        foreach ($cartItems as $cartItem) {
            $total += $cartItem->quantity * $cartItem->prix;
        }

        $date = now(); // Obtient la date et l'heure actuelles

        // Convertir la date en format jour-mois-année
        $dateString = $date->format('d-m-Y');

        // Générer un uniqid
        $uniqid = uniqid();

        // Concaténer la date et uniqid
        $reference = $dateString . '-' . $uniqid;

        // Créer une commande
        $order = Order::create([
            'user_id' => Auth::user()->id,
            'somme' => $total,
            'statut' => 0,
            'reference' => $reference
        ]);

        // dd($order);
        // Enregistrer les détails de la commande (éléments du panier)
        foreach ($cartItems as $cartItem) {
            // Je récupère le produit par rapport à son id
            $product = Product::find($cartItem->product_id);
            // dd($product->category->name);

            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'product_name' => $product->name,
                'category_name' => $product->category->name, // Récupérer le nom de la catégorie
                'quantity' => $cartItem->quantity,
                'prix' => $cartItem->prix,
            ]);
        }

        return view('checkout', [
            'categories' => $categories,
        ]);
    }

}
