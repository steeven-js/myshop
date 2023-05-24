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
                                {{ $item->somme }}€
                            </td>
                            <td>
                                <a href="{{ route('commandeDetail', $item->id) }}">
                                    Détails
                                </a>
                            </td>
                        </tr>
                    @empty
                        <p>Vous n'avez pas de commande. <a href="#">Parcourez notre catalogue de produits</a></p>
                    @endforelse

                </tbody>
            </table>

        </div>

    </div>
@endsection
