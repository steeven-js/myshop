@extends('layouts.myshop')
@section('main')
    <h1>Mes adresses</h1>
    <a href="{{ route('order') }}">Mes commandes</a><br>
    <a href="{{ route('address') }}">Mes adresses</a><br>
    <a href="{{ route('address.add') }}">Créer une adresse</a><br>

    @forelse ($addresses as $address)
        <ul>
            <li>{{ $address->name }}</li>
            <li>{{ $address->company }}</li>
            <li>{{ $address->address }}</li>
            <li>{{ $address->postal }}</li>
            <li>{{ $address->city }}</li>
            <li>{{ $address->country }}</li>
            <li>{{ $address->phone }}</li>
            <li>{{ $address->updated_at }}</li>
        </ul>
        <a href="{{ route('address.edit', $address->id) }}">Modifier</a>
        <a href="{{ route('address.delete', $address->id) }}">Supprimer</a><br>
    @empty
        <p>Vous n'avez pas d'adresse <a href="#">Cliquer ici pour en créer une</a> </p>
    @endforelse
@endsection
