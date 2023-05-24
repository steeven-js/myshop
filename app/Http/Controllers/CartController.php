<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    //

    public function index()
    {
        # code...
        $carts = Cart::Where('user_id', Auth::user()->id)->get();
        $products = Product::OrderBy('created_at', 'asc')->paginate(10);
        $categories = Category::OrderBy('name', 'asc')->get(); // liste de mes catégories
        $somme = 0;

        foreach ($carts as $itemCart) {

            # code...
            $somme = ($itemCart->quantity * $itemCart->prix) + $somme;
        }

        return view('cart', compact('carts', 'products', 'categories', 'somme'));
    }


    /*
        Méthode qui permet d'ajouter dans le caddie
        D'ajouter ou de modifier dans le caddie 
        Il vérifie si la quantité existe
        Si la quantité existe il exécute une action
    */

    public function addToCart(Product $product)
    {

        // Vérification du produit dans le panier 
        // Sélectionner le produit quand il a été ajouté par l'utilisateur 
        // SELECT * FROM Carts WHERE user_id = "?" AND product_id = $product -> id LIMIT(0, 1) 

        $cart = Cart::Where('user_id', Auth::user()->id)
            ->Where('product_id', $product->id)
            ->first();

        // Penser à controler l'existence du produit 

        if (isset($cart)) {

            // UPDATE Carts SET quantity = 1 WHERE id = 1

            Cart::Where('id', $cart->id)->update(['quantity' => $cart->quantity + 1]);
        } else {

            Cart::Create([
                "user_id" => Auth::user()->id,
                "product_id" => $product->id,
                "quantity" => 1,
                "prix" => $product->prix
            ]);
        };

        // Ajouter ou supprimer le produit 

        return redirect(route('cart'));
    }

    // Incrémenter
    public function incrementCartItem(Product $product)
    {
        // Vérifier si le produit existe dans le panier de l'utilisateur
        $cart = Cart::where('user_id', Auth::user()->id)
            ->where('product_id', $product->id)
            ->first();

        if ($cart) {
            // Incrémenter la quantité du produit dans le panier
            $cart->update(['quantity' => $cart->quantity + 1]);
            // dd($cart);
        } else {
            // Créer un nouvel élément dans le panier avec une quantité de 1
            Cart::create([
                'user_id' => Auth::user()->id,
                'product_id' => $product->id,
                'quantity' => 1,
                'prix' => $product->prix
            ]);
        }

        return redirect(route('cart'));
    }


    // Décrémenter
    public function decrementCartItem(Product $product)
    {
        // Vérifier si le produit existe dans le panier de l'utilisateur
        $cart = Cart::where('user_id', Auth::user()->id)
            ->where('product_id', $product->id)
            ->first();

        if ($cart) {
            // Décrémenter la quantité du produit dans le panier
            if ($cart->quantity > 1) {
                $cart->update(['quantity' => $cart->quantity - 1]);
            } else {
                // Si la quantité est déjà 1, supprimer l'élément du panier
                $cart->delete();
            }
        }

        return redirect(route('cart'));
    }

    public function checkout()
    {
        // Récupérer le panier de l'utilisateur
        $cartItems = Cart::where('user_id', Auth::user()->id)->get();

        // Calculer la somme du panier
        $total = 0;
        foreach ($cartItems as $cartItem) {
            $total += $cartItem->quantity * $cartItem->prix;
        }

        // Créer une commande
        $order = Order::create([
            'user_id' => Auth::user()->id,
            'somme' => $total,
        ]);
        
        // dd($order);
        // Enregistrer les détails de la commande (éléments du panier)
        foreach ($cartItems as $cartItem) {
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'quantity' => $cartItem->quantity,
                'prix' => $cartItem->prix
            ]);
        }

        // Supprimer les éléments du panier de l'utilisateur
        Cart::where('user_id', Auth::user()->id)->delete();

        // Rediriger vers une page de confirmation ou toute autre action appropriée
        return redirect(route('welcome'));
    }



    public function delete()
    {
        # code...
    }
}
