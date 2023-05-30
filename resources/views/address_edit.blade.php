@extends('layouts.myshop')
@section('main')
    <form action="{{ !empty($address) ? route('address.edit', $address->id) : route('address.add') }}" method="post">
        {{-- @dump($request) --}}
        @csrf

        <label for="name" class="">
            name
        </label>
        <input type="text" name="name" placeholder="Sasissez un  name" value="{{ !empty($address) ? $address->name : '' }}">

        <label for="company" class="">
            company
        </label>
        <input type="text" name="company" placeholder="Sasissez un  company" value="{{ !empty($address) ? $address->company : '' }}">

        <label for="address" class="">
            address
        </label>
        <input type="text" name="address" placeholder="Sasissez un  address" value="{{ !empty($address) ? $address->address : '' }}">

        <label for="postal" class="">
            postal
        </label>
        <input type="text" name="postal" placeholder="Sasissez un  postal" value="{{ !empty($address) ? $address->postal : '' }}">

        <label for="city" class="">
            city
        </label>
        <input type="text" name="city" placeholder="Sasissez un  city" value="{{ !empty($address) ? $address->city : '' }}">

        <label for="country" class="">
            country
        </label>
        <input type="text" name="country" placeholder="Sasissez un  country" value="{{ !empty($address) ? $address->country : '' }}">

        <label for="phone" class="">
            phone
        </label>
        <input type="text" name="phone" placeholder="Sasissez un  phone" value="{{ !empty($address) ? $address->phone : '' }}">

        <button type="submit">Créer</button>
    </form>
@endsection
