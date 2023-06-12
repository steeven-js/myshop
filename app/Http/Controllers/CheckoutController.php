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
        $categories = Category::orderBy('name', 'asc')->get(); // liste de mes catégories

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

        // Vérifier si une commande en cours existe pour l'utilisateur
        $order = Order::where('user_id', Auth::user()->id)->where('statut', 0)->first();

        if ($order) {
            // Mise à jour de la commande existante
            $order->somme = $total;
            $order->save();

            // Mettre à jour les détails de la commande existants
            foreach ($order->orderDetails as $orderDetail) {
                $cartItem = $cartItems->firstWhere('product_id', $orderDetail->product_id);
                if ($cartItem) {
                    $product = Product::find($cartItem->product_id);
                    $orderDetail->order_id = $order->id;
                    $orderDetail->product_id = $cartItem->product_id;
                    $orderDetail->product_name = $product->name;
                    $orderDetail->category_name = $product->category->name;
                    $orderDetail->quantity = $cartItem->quantity;
                    $orderDetail->prix = $cartItem->prix;
                    $orderDetail->save();
                } else {
                    $orderDetail->delete();
                }
            }
        } else {
            // Création d'une nouvelle commande
            $order = Order::create([
                'user_id' => Auth::user()->id,
                'somme' => $total,
                'statut' => 0,
                'reference' => $reference
            ]);

            // Enregistrer les détails de la commande (éléments du panier)
            foreach ($cartItems as $cartItem) {
                // Je récupère le produit par rapport à son id
                $product = Product::find($cartItem->product_id);

                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'product_name' => $product->name,
                    'category_name' => $product->category->name, // Récupérer le nom de la catégorie
                    'quantity' => $cartItem->quantity,
                    'prix' => $cartItem->prix,
                ]);
            }
        }

        // Mettre à jour les détails de commande lors de l'accès à la vue checkout
        $this->updateOrderDetails();

        return view('checkout', [
            'categories' => $categories,
        ]);
    }

    /**
     * Met à jour les détails de commande.
     */
    private function updateOrderDetails()
    {
        // Récupérer l'utilisateur connecté
        $user = Auth::user();

        // Récupérer la commande en cours de l'utilisateur avec un statut de 0 (non payée)
        $order = Order::where('user_id', $user->id)->where('statut', 0)->first();

        // Récupérer le panier de l'utilisateur
        $cartItems = Cart::where('user_id', $user->id)->get();

        // Mettre à jour les détails de la commande
        foreach ($cartItems as $cartItem) {
            // Vérifier si le produit existe déjà dans les détails de commande
            $orderDetail = OrderDetail::where('order_id', $order->id)->where('product_id', $cartItem->product_id)->first();

            if ($orderDetail) {
                // Le produit existe déjà, mettre à jour les propriétés
                $orderDetail->quantity = $cartItem->quantity;
                $orderDetail->prix = $cartItem->prix;
                $orderDetail->save();
            } else {
                // Le produit n'existe pas, créer un nouveau détail de commande
                $product = Product::find($cartItem->product_id);

                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'product_name' => $product->name,
                    'category_name' => $product->category->name,
                    'quantity' => $cartItem->quantity,
                    'prix' => $cartItem->prix,
                ]);
            }
        }
    }
}
