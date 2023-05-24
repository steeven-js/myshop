@extends('layouts.myshop')
@section('main')
    <div role="main" class="main shop pb-4">

        <div class="container">

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>
                            # Numéro
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
                    @forelse ($orders as $item)
                        <tr>
                            <td>
                                {{ $item->id }}
                            </td>
                            <td>
                                {{ $item->user->name }}
                            </td>
                            <td>
                                {{ $item->created_at }}
                            </td>
                            <td>
                                {{ $item->somme }} €
                            </td>
                            <td>
                                @if ($item->statut == 0)
                                    <p>Commande validée</p>
                                @elseif ($item->statut == 1)
                                    <p>Commande en cours de préparation</p>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('commandeDetail', $item->id) }}">
                                    Détails
                                </a>
                            </td>
                        </tr>
                    @empty
                        <p>Vous n'avez pas de commande. <a href="{{ route('welcome') }}">Parcourez notre catalogue de produits</a></p>
                    @endforelse

                </tbody>
            </table>

        </div>

    </div>
@endsection
