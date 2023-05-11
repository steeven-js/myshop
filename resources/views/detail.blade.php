<img class="h-full w-full object-cover object-center" src="{{ Storage::url($product->image) }}" alt="" />

<h3>{{ Str::limit($product->name) }}</h3>
<P>{{ $product->description }}</P>
<P>{{ $product->prix }}€</P>

<a href="{{ route('addtocart', $product) }}">Ajouter au panier</a>