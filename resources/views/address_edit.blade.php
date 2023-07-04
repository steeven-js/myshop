@extends('layouts.myshop')
@section('main')
    <div class="row">
        <div class="col-lg-3 order-2 order-lg-1">

            <aside class="sidebar mt-2 mb-5">
                <h5 class="font-weight-semi-bold">Dashboard</h5>
                <ul class="nav nav-list flex-column">

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('order') }}">Mes commandes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('address') }}">Mes adresses</a>
                    </li>
                </ul>
            </aside>

        </div>
        <div class="col-lg-9 order-1 order-lg-2">

            <div class="tab-pane tab-pane-navigation active" id="formsStyleDefault">

                <h4 class="mb-3">{{ !empty($address) ? 'Modifier une adresse' : 'Créer une adresse' }}</h4>
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <form
                                    action="{{ !empty($address) ? route('address.edit', $address->id) : route('address.add') }}"
                                    method="post">
                                    {{-- @dump($request) --}}
                                    @csrf
                                    <div class="contact-form-success alert alert-success d-none mt-4">
                                        <strong>Success!</strong> Your message has been sent to us.
                                    </div>

                                    <div class="contact-form-error alert alert-danger d-none mt-4">
                                        <strong>Error!</strong> There was an error sending your message.
                                        <span class="mail-error-message text-1 d-block"></span>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-lg-6">
                                            <label for="name" class="form-label mb-1 text-2">Nom</label>
                                            <input type="text" value="{{ !empty($address) ? $address->name : '' }}"
                                                data-msg-required="Please enter your name." maxlength="100"
                                                class="form-control text-3 h-auto py-2" name="name">
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="company" class="form-label mb-1 text-2">Company</label>
                                            <input type="text" value="{{ !empty($address) ? $address->company : '' }}"
                                                data-msg-required="Please enter your name." maxlength="100"
                                                class="form-control text-3 h-auto py-2" name="company">
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="form-group col">
                                            <label for="address" class="form-label mb-1 text-2">Adresse</label>
                                            <input type="text" value="{{ !empty($address) ? $address->address : '' }}"
                                                data-msg-required="Please enter your name." maxlength="100"
                                                class="form-control text-3 h-auto py-2" name="address">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-6">
                                            <label for="city" class="form-label mb-1 text-2">Ville</label>
                                            <input type="text" value="{{ !empty($address) ? $address->city : '' }}"
                                                data-msg-required="Please enter your name." maxlength="100"
                                                class="form-control text-3 h-auto py-2" name="city">
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="postal" class="form-label mb-1 text-2">Code postal</label>
                                            <input type="text" value="{{ !empty($address) ? $address->postal : '' }}"
                                                data-msg-required="Please enter your name." maxlength="100"
                                                class="form-control text-3 h-auto py-2" name="postal">
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-6">
                                            <label for="country" class="form-label mb-1 text-2">Pays</label>
                                            <input type="text" value="{{ !empty($address) ? $address->country : '' }}"
                                                data-msg-required="Please enter your name." maxlength="100"
                                                class="form-control text-3 h-auto py-2" name="country">
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="Phone" class="form-label mb-1 text-2">Phone</label>
                                            <input type="text" value="{{ !empty($address) ? $address->Phone : '' }}"
                                                data-msg-required="Please enter your name." maxlength="100"
                                                class="form-control text-3 h-auto py-2" name="Phone">
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="form-group col">
                                            <input type="submit" value="Submit Form" class="btn btn-primary"
                                                data-loading-text="Loading...">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
@endsection
