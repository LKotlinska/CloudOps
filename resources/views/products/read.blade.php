<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $product->name }}</title>
</head>
<body>
    <form action="/logout" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
    
    <h1>Product view</h1>

    <a href="{{ route('products.create')}}">New product</a>

    <article>
        <h2>{{ $product->name }}</h2>
        <table>
            <tbody>

                <tr>
                    <th>Description</th>
                    <td>{{ $product->description }}</td>
                </tr>

                <tr>
                    <th>Product type</th>
                    <td>{{ $product->category->name}}</td>
                </tr>

                @if(strtolower($product->category->name) === 'vape')
                <tr>
                    <th>Refillable</th>
                    <td>{{ $product->productVape?->has_podsystem ? 'Yes' : 'No' }}</td>
                </tr>
                <tr>
                    <th>Puff count</th>
                    <td>{{ $product->productVape?->puff_count }}</td>
                </tr>
                <tr>
                    <th>Color</th>
                    <td>{{ $product->productVape?->color?->name }}</td>
                </tr>
                @endif

                <tr>
                    <th>Price</th>
                    <td>{{ $product->price}}</td>
                </tr>

                <tr>
                    <th>In stock</th>
                    <td>{{ $product->stock}}</td>
                </tr>

                <tr>
                    <th>Brand name</th>
                    <td>{{ $product->brand->name}}</td>
                </tr>

                <tr>
                    <th>Flavor</th>
                    <td>
                        @foreach($product->flavors as $flavor)
                            {{ $flavor->name }}
                        @endforeach
                    </td>
                </tr>

                <tr>
                    <th>Nicotine strength in mg</th>
                    <td>{{ $product->nicotine_strength_mg}}</td>
                </tr>

                <tr>
                    <th>Volume in ml</th>
                    <td>{{ $product->volume_ml}}</td>
                </tr>

            </tbody>
        </table>
    </article>

        <a href="{{ route('products.edit', $product) }}">Edit</a>

        <form action="{{ route('products.destroy', $product)}}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>

</body>
</html>