<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\Auth;

class StripeController extends Controller
{
    //
    public function stripe_create_session($reference)
    {
        $order = Order::where('reference', $reference)->first();

        $YOUR_DOMAIN = 'http://127.0.0.1:8000';
        //$YOUR_DOMAIN = 'http://js-tech.fr';
        $product_for_stripe = [];

        if ($order) {
            // La commande correspondante a été trouvée
            $orderDetails = $order->orderDetails;

            // Panier
            foreach ($orderDetails as $orderDetail) {
                $productObject = Product::where('name', $orderDetail->product_name)->first();

                $product_for_stripe[] = [
                    'price_data' => [
                        'currency' => 'eur',
                        'unit_amount' => $productObject->prix * 100,
                        'product_data' => [
                            'name' => $productObject->name,
                            'images' => [$YOUR_DOMAIN . "/storage/" . $productObject->image],
                        ],
                    ],
                    'quantity' => $orderDetail->quantity,
                ];
            }

            // API Stripe pour le paiement
            Stripe::setApiKey('sk_test_51LeOHYBy39DOXZlGW09bx55BbH1bl4HiaBQbUKUns3aW94VFvRowCJUx8b7gohpOWSe7g4ms1y57H3AAub444zsX00ehwupWiB');

            $checkout_session = Session::create([
                'customer_email' => Auth::user()->email,
                'line_items' => [
                    $product_for_stripe
                ],
                'payment_method_types' => [
                    'card',
                ],
                'mode' => 'payment',
                'success_url' => $YOUR_DOMAIN . '/commande/merci/{CHECKOUT_SESSION_ID}',
                'cancel_url' => $YOUR_DOMAIN . '/commande/erreur/{CHECKOUT_SESSION_ID}',
            ]);

            $order->stripe_id = $checkout_session->id;

            // dd($order);

            $order->save();

            return redirect($checkout_session->url);
        } else {

            

        }


        return view('checkout');
    }
}
