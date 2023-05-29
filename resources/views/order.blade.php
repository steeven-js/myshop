@extends('layouts.myshop')
@section('main')
    {{-- @dump($orders) --}}
    <div role="main" class="main shop pb-4">

        <div class="container">

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <ul
                        class="breadcrumb breadcrumb-dividers-no-opacity font-weight-bold text-6 justify-content-center my-5">
                        <li class="text-transform-none me-2">
                            <a href="{{ route('account') }}"
                                class="text-decoration-none text-color-dark text-color-hover-primary">Mon compte</a>
                        </li>
                        <li class="text-transform-none text-color-dark">
                            <a href="#" class="text-decoration-none text-color-primary">Mes commande</a>
                        </li>
                    </ul>
                </div>
            </div>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>
                            # Référence
                        </th>
                        <th>
                            Utilisateur
                        </th>
                        <th>
                            Date
                        </th>
                        <th>
                            Prix Total
                        </th>
                        <th>
                            Statut
                        </th>
                        <th>
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        <tr>
                            <td>
                                {{ $order->reference }}
                            </td>
                            <td>
                                {{ $order->user->name }}
                            </td>
                            <td>
                                {{ $order->created_at }}
                            </td>
                            <td>
                                {{ $order->somme }}€
                            </td>
                            <td>
                                @if ($order->statut == 1)
                                    <p>Commande validée</p>
                                @elseif ($order->statut == 2)
                                    <p>En cours de préparation</p>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('order.detail', $order->reference) }}">
                                    Détails
                                </a>
                            </td>
                        </tr>
                    @empty
                        @if (!$orders)
                            <p>Vous n'avez pas de commande. <a href="{{ route('welcome') }}">Parcourez notre catalogue de
                                    produits</a></p>
                        @endif
                    @endforelse
                </tbody>
            </table>

        </div>

    </div>
@endsection