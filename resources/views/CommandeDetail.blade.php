@extends('layouts.myshop')
@section('main')
    <div role="main" class="main shop pb-4">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <ul
                        class="breadcrumb breadcrumb-dividers-no-opacity font-weight-bold text-6 justify-content-center my-5">
                        <li class="text-transform-none me-2">
                            <a href="shop-cart.html"
                                class="text-decoration-none text-color-dark text-color-hover-primary">Panier</a>
                        </li>
                        <li class="text-transform-none text-color-dark me-2">
                            <a href="shop-checkout.html"
                                class="text-decoration-none text-color-dark text-color-hover-primary">Paiement</a>
                        </li>
                        <li class="text-transform-none text-color-dark">
                            <a href="shop-order-complete.html" class="text-decoration-none text-color-primary">Commande
                                validée</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card border-width-3 border-radius-0 border-color-success">
                        <div class="card-body text-center">
                            <p class="text-color-dark font-weight-bold text-4-5 mb-0"><i
                                    class="fas fa-check text-color-success me-1"></i>Merci! Votre commande a été validée</p>
                        </div>
                    </div>
                    <div class="d-flex flex-column flex-md-row justify-content-between py-3 px-4 my-4">
                        <div class="text-center">
                            <span>
                                Order Number <br>
                                <strong class="text-color-dark">{{ $order->id }}</strong>
                            </span>
                        </div>
                        <div class="text-center mt-4 mt-md-0">
                            <span>
                                Date <br>
                                <strong class="text-color-dark">{{ $order->created_at }}</strong>
                            </span>
                        </div>
                        <div class="text-center mt-4 mt-md-0">
                            <span>
                                Email <br>
                                <strong class="text-color-dark">{{ $order->user->email }}</strong>
                            </span>
                        </div>
                        <div class="text-center mt-4 mt-md-0">
                            <span>
                                Statut <br>
                                <strong class="text-color-dark">
                                    @if ($order->statut == 0)
                                        Commande validée
                                    @elseif ($order->statut == 1)
                                        Commande en cours de préparation
                                    @endif
                                </strong>
                            </span>
                        </div>
                    </div>
                    <div class="card border-width-3 border-radius-0 border-color-hover-dark mb-4">
                        <div class="card-body">
                            <h4 class="font-weight-bold text-uppercase text-4 mb-3">Votre commande</h4>
                            <table class="shop_table cart-totals mb-0">
                                <tbody>
                                    <tr>
                                        <td colspan="2" class="border-top-0">
                                            <strong class="text-color-dark">Produit(s)</strong>
                                        </td>
                                    </tr>
                                    @foreach ($orderDetails as $item)
                                        <tr>
                                            <td>
                                                <strong
                                                    class="d-block text-color-dark line-height-1 font-weight-semibold">{{ $item->product_name }}
                                                    <span class="product-qty">x{{ $item->quantity }}</span></strong>
                                                <span class="text-1">{{ $item->category_name }}</span>
                                            </td>
                                            <td class="text-end align-top">
                                                <span
                                                    class="amount font-weight-medium text-color-grey">{{ $item->prix }}€</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr class="cart-subtotal">
                                        <td class="border-top-0">
                                            <strong class="text-color-dark">Subtotal</strong>
                                        </td>
                                        <td class="border-top-0 text-end">
                                            <strong><span
                                                    class="amount font-weight-medium">{{ $order->somme }}€</span></strong>
                                        </td>
                                    </tr>
                                    <tr class="shipping">
                                        <td class="border-top-0">
                                            <strong class="text-color-dark">Livraison</strong>
                                        </td>
                                        <td class="border-top-0 text-end">
                                            <strong><span class="amount font-weight-medium">Livraison
                                                    gratuite</span></strong>
                                        </td>
                                    </tr>
                                    <tr class="total">
                                        <td>
                                            <strong class="text-color-dark text-3-5">Total</strong>
                                        </td>
                                        <td class="text-end">
                                            <strong class="text-color-dark"><span
                                                    class="amount text-color-dark text-5">{{ $order->somme }}€</span></strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
