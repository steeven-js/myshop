<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderCarrier;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\Auth;

class StripeController extends Controller
{
    public function stripe_create_session($reference)
    {
        $order = Order::where('reference', $reference)->first();

        $YOUR_DOMAIN = env('APP_URL');
        $product_for_stripe = [];

        if ($order) {
            $orderDetails = $order->orderDetails;

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

            $orderCarrier = OrderCarrier::where('order_id', $order->id)->first();

            if ($orderCarrier) {
                $transportPrice = $orderCarrier->price;
                $transportName = $orderCarrier->name;

                $product_for_stripe[] = [
                    'price_data' => [
                        'currency' => 'eur',
                        'unit_amount' => $transportPrice * 100,
                        'product_data' => [
                            'name' => $transportName,
                        ],
                    ],
                    'quantity' => 1,
                ];
            }

            Stripe::setApiKey(env('STRIPE_API_KEY'));

            $checkout_session = Session::create([
                'customer_email' => Auth::user()->email,
                'line_items' => $product_for_stripe,
                'payment_method_types' => [
                    'card',
                ],
                'mode' => 'payment',
                'success_url' => $YOUR_DOMAIN . '/commande/merci/{CHECKOUT_SESSION_ID}',
                'cancel_url' => $YOUR_DOMAIN . '/commande/erreur/{CHECKOUT_SESSION_ID}',
            ]);

            $order->stripe_id = $checkout_session->id;
            $order->save();

            return redirect($checkout_session->url);
        }

        return view('checkout');
    }
}
