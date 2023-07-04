@extends('layouts.myshop')
@section('main')
    <div role="main" class="main shop pt-4">

        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <aside class="sidebar">
                        <h5 class="font-weight-semi-bold pt-3">Dashboard</h5>
                        <ul class="nav nav-list flex-column">
                            <li class="nav-item"><a class="nav-link" href="{{ route('order') }}">Mes commandes</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('address') }}">Mes adresses</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('address.add') }}">Créer une adresse</a>
                            </li>
                        </ul>
                    </aside>
                </div>
                <div class="col-lg-9">
                    <div class="row mb-5 pb-3">
                        <h5 class="font-weight-semi-bold pt-3">Mes adresses</h5>
                        @forelse ($addresses as $address)
                            <div class="col-lg-4 mb-5 mb-lg-0 appear-animation" data-appear-animation="fadeInUpShorter"
                                data-appear-animation-delay="200">

                                <div class="card border-0 border-radius-0 bg-color-grey">
                                    <div class="card-body">
                                        <h4 class="card-title mb-1 text-4 font-weight-bold">{{ $address->name }}</h4>
                                        @if ($address->company)
                                            <p class="card-text">{{ $address->company }}</p>
                                        @endif
                                        <p class="card-text">{{ $address->city }} {{ $address->postal }}</p>
                                        <p class="card-text">{{ $address->country }}</p>
                                        <p class="card-text">{{ $address->phone }}</p>

                                        <a href="{{ route('address.edit', $address->id) }}">Modifier</a>
                                        <a href="{{ route('address.delete', $address->id) }}">Supprimer</a><br>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p>Vous n'avez pas d'adresse <a href="#">Cliquer ici pour en créer une</a> </p>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection
