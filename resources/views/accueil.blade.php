@extends('layouts.myshop')

@section('main')
    <div class="masonry-loader masonry-loader-showing">
        <div class="row products product-thumb-info-list" data-plugin-masonry data-plugin-options="{'layoutMode': 'fitRows'}">
            @forelse ($products as $itemProduct)
                <x-product.card :itemProduct="$itemProduct" />
            @empty
                <p>Pas de produit</p>
            @endforelse
        </div>
    </div>
@endsection
