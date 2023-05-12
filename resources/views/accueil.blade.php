@extends('layouts.myshop')

@section('main')
    <div class="masonry-loader masonry-loader-showing">
        <div class="row products product-thumb-info-list" data-plugin-masonry data-plugin-options="{'layoutMode': 'fitRows'}">

            <div class="col-12 col-sm-6 col-lg-3">
                <p>Je suis ici</p>
            </div>
        </div>
    </div>
    <div>

        </ul>

        <h1>Products</h1>

        <ul>

            @foreach ($products as $itemProduct)
                <li>
                    {{ $itemProduct->name }}
                    <a href="{{ route('accueil.detail', $itemProduct) }}">
                        Voir plus
                    </a>
                </li>
            @endforeach

        </ul>

    </div>
@endsection
