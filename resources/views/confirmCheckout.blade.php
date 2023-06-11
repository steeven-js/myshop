@extends('layouts.myshop')
@section('main')
    <div class="row">
        <h3>Confirm Checkout</h3>
        <p>Selected Address:</p>
        @if ($selectedAddress)
            <p>
                <strong>Address:</strong> {{ $selectedAddress->address }}<br>
                <strong>Postal Code:</strong> {{ $selectedAddress->postal }}<br>
                <strong>City:</strong> {{ $selectedAddress->city }}<br>
                <strong>Country:</strong> {{ $selectedAddress->country }}<br>
                <strong>Phone:</strong> {{ $selectedAddress->phone }}<br>
            </p>
        @else
            <p>No address selected.</p>
        @endif

        <p>Selected Carrier:</p>
        @if ($selectedCarrier)
            <p>
                <strong>Name:</strong> {{ $selectedCarrier->name }}<br>
                <strong>Price:</strong> {{ $selectedCarrier->price }}<br>
                <strong>Description:</strong> {{ $selectedCarrier->description }}<br>
            </p>
        @else
            <p>No carrier selected.</p>
        @endif
    </div>
    <div class="row pb-4 mb-5">
        <a href="{{ route('stripe') }}"
            class="btn btn-dark btn-modern w-100 text-uppercase bg-color-hover-primary border-color-hover-primary border-radius-0 text-3 py-3">Proceed
            to Checkout <i class="fas fa-arrow-right ms-2"></i></a>
    </div>
@endsection
