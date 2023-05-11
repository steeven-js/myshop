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
                Prix
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
            </tr>
        @endforeach
    </tbody>
</table>
