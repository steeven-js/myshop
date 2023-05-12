@extends('layouts.myshop')

@section("main")

<div>

    <h1>Categories</h1>

    <ul>

        @foreach ($categories as $itemCategory)

        <li>

            <a href="{{route('accueil', $itemCategory)}}">
            {{$itemCategory->name}}
            </a>

        </li>

        @endforeach

            </ul>

                <h1>Products</h1>

            <ul>

                @foreach ($products as $itemProduct)

                <li>
                    {{$itemProduct->name}}
                    <a href="{{route('accueil.detail', $itemProduct)}}">
                        Voir plus
                    </a>
                </li>

                @endforeach

            </ul>

</div>

@endsection