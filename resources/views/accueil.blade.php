@extends('layouts.myshop')
    @forelse ($categories as $itemcategories)
        <a href="{{ route('accueil', $itemcategories->id) }}" class="mr-5">
            {{ $itemcategories->name }}
        </a>
    @empty
    @endforelse

    {{ $products->links() }}
    @forelse ($products as $itemproduct)
        <a href="{{ route('accueil.detail', $itemproduct) }}">
            <img class="h-full w-full object-cover object-center" src="{{ Storage::url($itemproduct->image) }}"
                alt="" />

            <h3>{{ Str::limit($itemproduct->name, 20) }}</h3>
        </a>
    @empty
        <p>Pas de produits</p>
    @endforelse
</body>

</html>
