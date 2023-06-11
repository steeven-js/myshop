@extends('layouts.myshop')
@section('main')
    <div class="row pb-4 mb-5">
        <form action="{{ route('shipping') }}" method="POST">
            @csrf

            <h3>Choose your shipping address:</h3>
            @foreach ($addresses as $address)
                <div>
                    <input type="radio" name="address_id" value="{{ $address->id }}" required
                        {{ $order && $order->orderAddress && $order->orderAddress->address_id == $address->id ? 'checked' : '' }}>
                    <label>
                        <strong>Address:</strong> {{ $address->address }}<br>
                        <strong>Postal Code:</strong> {{ $address->postal }}<br>
                        <strong>City:</strong> {{ $address->city }}<br>
                        <strong>Country:</strong> {{ $address->country }}<br>
                        <strong>Phone:</strong> {{ $address->phone }}<br>
                    </label>
                </div>
            @endforeach

            <h3>Choose your transporter:</h3>
            @foreach ($carriers as $carrier)
                <div>
                    <input type="radio" name="carrier_id" value="{{ $carrier->id }}" required
                        {{ $orderCarrier && $orderCarrier->carrier_id == $carrier->id ? 'checked' : '' }}>
                    <label>
                        <strong>Name:</strong> {{ $carrier->name }}<br>
                        <strong>Price:</strong> {{ $carrier->price }}<br>
                        <strong>Description:</strong> {{ $carrier->description }}<br>
                    </label>
                </div>
            @endforeach

            <button type="submit">Select Address and Transporter</button>
        </form>
    </div>
    <div class="row pb-4 mb-5">
        <a href="{{ route('confirm') }}"
            class="btn btn-dark btn-modern w-100 text-uppercase bg-color-hover-primary border-color-hover-primary border-radius-0 text-3 py-3">Proceed
            to Checkout <i class="fas fa-arrow-right ms-2"></i></a>
    </div>
@endsection
