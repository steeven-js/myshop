@extends('layouts.myshop')
@section('main')
    <div class="row pb-4 mb-5">
        <div class="col-md-12">
            <h2>Récapitulatif de commande</h2>
            <h4>Référence de commande: {{ $order->reference }}</h4>
            <hr>
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title">Détails de la commande:</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Produit</th>
                                <th>Catégorie</th>
                                <th>Quantité</th>
                                <th>Prix unitaire</th>
                                <th>Sous-total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderDetails as $orderDetail)
                                <tr>
                                    <td>{{ $orderDetail->product_name }}</td>
                                    <td>{{ $orderDetail->category_name }}</td>
                                    <td>x{{ $orderDetail->quantity }}</td>
                                    <td>{{ $orderDetail->prix }}€</td>
                                    <td>{{ $orderDetail->quantity * $orderDetail->prix }}€</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card mb-4 m-3 d-flex flex-wrap gap-3">
                <div class="card-group">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Adresse de livraison:</h5>
                            <p>Adresse: {{ $shippingAddress->address }}</p>
                            <p>Code postal: {{ $shippingAddress->postal_code }}</p>
                            <p>Ville: {{ $shippingAddress->city }}</p>
                            <p>Pays: {{ $shippingAddress->country }}</p>
                            <p>Téléphone: {{ $shippingAddress->phone }}</p>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Transporteur:</h5>
                            <p>Nom: {{ $carrier->name }}</p>
                            <p>Prix: {{ $carrier->price }}€</p>
                        </div>
                    </div>
                </div>

            <hr>
            <a href="{{ route('stripe', ['reference' => $order->reference]) }}"
                class="btn btn-dark btn-modern w-100 text-uppercase bg-color-hover-primary border-color-hover-primary border-radius-0 text-3 py-3">Total de la commande: {{ $order->somme }}€<i class="fas fa-arrow-right ms-2"></i></a>
        </div>
    </div>
@endsection
