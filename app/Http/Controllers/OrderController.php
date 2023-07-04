<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Address;
use App\Models\Carrier;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderDetail;
use App\Models\OrderAddress;
use App\Models\OrderCarrier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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

    public function add()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        $user = Auth::user();
        $addresses = $user->addresses;

        // Récupérer l'adresse sélectionnée de la commande en cours de l'utilisateur
        $order = Order::where('user_id', $user->id)->where('statut', 0)->first();

        // Récupérer le transporteur sélectionné de la commande en cours de l'utilisateur
        $orderCarrier = null;
        if ($order) {
            $orderCarrier = $order->orderCarrier;
        }

        // Récupérer les transporteurs disponibles
        $carriers = Carrier::all();

        return view('add', compact('categories', 'addresses', 'order', 'carriers', 'orderCarrier'));
    }

    public function store(Request $request)
    {

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

        $user = Auth::user();
        $addressId = $request->input('address_id');
        $carrierId = $request->input('carrier_id');

        $address = Address::findOrFail($addressId);
        $carrier = Carrier::findOrFail($carrierId);

        // Récupérer la commande en cours de l'utilisateur
        $order = Order::where('user_id', $user->id)->where('statut', 0)->first();

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

        // Vérifier s'il existe déjà une adresse dans OrderAddress pour cette commande
        $orderAddress = $order->orderAddress;

        if ($orderAddress) {
            // Mettre à jour l'adresse existante dans OrderAddress
            $orderAddress->update([
                'address_id' => $addressId,
                'address' => $address->address,
                'postal_code' => $address->postal,
                'city' => $address->city,
                'country' => $address->country,
                'phone' => $address->phone,
            ]);
        } else {
            // Créer une nouvelle entrée dans la table OrderAddress
            $orderAddress = new OrderAddress([
                'order_id' => $order->id,
                'address_id' => $addressId,
                'address' => $address->address,
                'postal_code' => $address->postal,
                'city' => $address->city,
                'country' => $address->country,
                'phone' => $address->phone,
            ]);
            $orderAddress->save();
        }

        // Vérifier s'il existe déjà un transporteur dans OrderCarrier pour cette commande
        $orderCarrier = $order->orderCarrier;

        if ($orderCarrier) {
            // Mettre à jour le transporteur existant dans OrderCarrier
            $orderCarrier->update([
                'carrier_id' => $carrierId,
                'name' => $carrier->name,
                'description' => $carrier->description,
                'price' => $carrier->price,
            ]);
        } else {
            // Créer une nouvelle entrée dans la table OrderCarrier
            $orderCarrier = new OrderCarrier([
                'order_id' => $order->id,
                'carrier_id' => $carrierId,
                'name' => $carrier->name,
                'description' => $carrier->description,
                'price' => $carrier->price,
            ]);
            $orderCarrier->save();
        }

        return redirect()->route('checkout');
    }

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
