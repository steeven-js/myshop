<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Address;
use App\Models\Category;
use App\Models\OrderAddress;
use App\Models\OrderCarrier;
use App\Models\Carrier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ShippingController extends Controller
{
    /**
     * Display the shipping addresses and carriers to the user.
     */
    public function shipping()
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

        return view('shipping', compact('categories', 'addresses', 'order', 'carriers', 'orderCarrier'));
    }

    /**
     * Store the selected shipping address and carrier in the order.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $addressId = $request->input('address_id');
        $carrierId = $request->input('carrier_id');

        $address = Address::findOrFail($addressId);
        $carrier = Carrier::findOrFail($carrierId);

        // Récupérer la commande en cours de l'utilisateur
        $order = Order::where('user_id', $user->id)->where('statut', 0)->first();

        if (!$order) {
            // Créer une nouvelle commande si elle n'existe pas
            $order = new Order([
                'user_id' => $user->id,
                'status' => 0,
            ]);
            $order->save();
        }

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

        return redirect()->route('shipping');
    }
}
