@extends('layouts.myshop')
@section('main')
    <h1>Mon compte</h1>
    <a href="{{ route('order') }}">Mes commandes</a><br>
    <a href="{{ route('address') }}">Mes adresses</a>
@endsection