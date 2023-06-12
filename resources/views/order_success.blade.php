@extends('layouts.myshop')
@section('main')
    {{-- @dump($order) --}}
    <div role="main" class="main shop pb-4">

        <div class="container">

            <h3>Merci <b> </b></h3>
            <br>
            <ul style="list-style:none;">
                <li>Nous vous remercions pour votre commande n° <b>{{ $order->reference }}</b></li>
                <li>Une confirmation vient de vous être envoyée par email à l'adresse suivante :
                    <b>{{ $order->user->email }}</b>
                </li>

                <br>

                <li>Votre commande sera livrée à l'adresse suivante :</li>
                @if ($selectedAddress)
                    <p>
                        <strong>Address:</strong> {{ $selectedAddress->address }}<br>
                        <strong>Postal Code:</strong> {{ $selectedAddress->postal_code }}<br>
                        <strong>City:</strong> {{ $selectedAddress->city }}<br>
                        <strong>Country:</strong> {{ $selectedAddress->country }}<br>
                        <strong>Phone:</strong> {{ $selectedAddress->phone }}<br>
                    </p>
                @else
                    <p>No address selected.</p>
                @endif

                <br>

                <li>Par le transporteur suivant: </li>

                @if ($selectedCarrier)
                    <p>
                        <strong>Name:</strong> {{ $selectedCarrier->name }}<br>
                        <strong>Price:</strong> {{ $selectedCarrier->price }}<br>
                        <strong>Description:</strong> {{ $selectedCarrier->description }}<br>
                    </p>
                @else
                    <p>No carrier selected.</p>
                @endif

                <br>

                <li>Pour suivre votre commande, rendez-vous dans votre <a href="{{ route('account') }}"><b>compte </b></a>
                </li>
            </ul>

        </div>

    </div>
@endsection
