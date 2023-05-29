@extends('layouts.myshop')
@section('main')
    {{-- @dump($order) --}}
    <div role="main" class="main shop pb-4">

        <div class="container">

            <h3>Bonjour <b> </b></h3>
            <br>
            <ul style="list-style:none;">
                <li>Nous vous remercions pour votre commande n° <b>{{ $order->reference }}</b></li>
                <li>Une confirmation vient de vous être envoyée par email à l'adresse suivante : <b>{{ $order->user->email }}</b></li>
        
                <br>
        
                <li>Votre commande sera livrée par <b></b> à l'adresse suivante :</li>
                <li></li> 
        
                <br>
        
                <li>Pour suivre votre commande, rendez-vous dans votre <a href="{{ route('account') }}"><b>compte </b></a></li>
            </ul>

        </div>

    </div>
@endsection