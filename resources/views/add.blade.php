@extends('layouts.myshop')
@section('main')
    <div class="row pb-4 mb-5">
        <form action="{{ route('order.recap.store') }}" method="POST">
            @csrf

            <h3>Choisissez une adresse:</h3>
            <div class="d-flex flex-wrap gap-3">
                @foreach ($addresses as $address)
                    <label class="card mb-3" for="address_{{ $address->id }}">
                        <div class="card-body">
                            <div class="form-check">
                                <input class="form-check-input position-static" type="radio" name="address_id"
                                    value="{{ $address->id }}" id="address_{{ $address->id }}" required
                                    {{ $order && $order->orderAddress && $order->orderAddress->address_id == $address->id ? 'checked' : '' }}>
                                <div class="card-text">
                                    <strong>Address:</strong> {{ $address->address }}<br>
                                    <strong>Postal Code:</strong> {{ $address->postal }}<br>
                                    <strong>City:</strong> {{ $address->city }}<br>
                                    <strong>Country:</strong> {{ $address->country }}<br>
                                    <strong>Phone:</strong> {{ $address->phone }}<br>
                                </div>
                            </div>
                        </div>
                    </label>
                @endforeach
            </div>

            <h3>Choisissez un transporteur:</h3>
            <div class="d-flex flex-wrap gap-3">
                @foreach ($carriers as $carrier)
                    <label class="card mb-3" for="carrier_{{ $carrier->id }}">
                        <div class="card-body">
                            <div class="form-check">
                                <input class="form-check-input position-static" type="radio" name="carrier_id" value="{{ $carrier->id }}" id="carrier_{{ $carrier->id }}" required
                                    {{ $orderCarrier && $orderCarrier->carrier_id == $carrier->id ? 'checked' : '' }}>
                                <div class="card-text">
                                    <strong>Name:</strong> {{ $carrier->name }}<br>
                                    <strong>Price:</strong> {{ $carrier->price }}€<br>
                                    <strong>Description:</strong> {{ $carrier->description }}<br>
                                </div>
                            </div>
                        </div>
                    </label>
                @endforeach
            </div>

            </div>


            <div class="row pb-4 mb-5">
                <button type="submit"
                    class="btn btn-dark btn-modern w-100 text-uppercase bg-color-hover-primary border-color-hover-primary border-radius-0 text-3 py-3">
                    Proceed to Checkout <i class="fas fa-arrow-right ms-2"></i>
                </button>
            </div>
        </form>
    </div>
@endsection
