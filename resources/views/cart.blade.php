<table>
    <thead>
        <tr>
            <th>
                Nom du produit
            </th>
            <th>
                Quantité
            </th>
            <th>
                Prix unitaire
            </th>
            <th>
                Prix total
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($cart as $itemcart)
            <tr>
                <th>
                    <p>{{ $itemcart->product->name }}</p>
                </th>
                <td>
                    <p>{{ $itemcart->quantity }}</p>
                </td>
                <td>
                    <p>{{ $itemcart->price }}€</p>
                </td>
                <td>
                    <p>{{ ($itemcart->price) * ($itemcart->quantity) }}€</p>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<a href="#">Valider mon panier</a>
