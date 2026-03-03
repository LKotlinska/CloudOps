<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="{{ asset('css/product.css') }}">
</head>
<body>

@include('errors')

<form id="add-form" action="{{ route('products.store') }}" method="POST">
    @csrf
    
    <label for="name">Product name:</label>
    <input 
    type="text" 
    id="name" 
    name="name"
    placeholder="e.g. Vape startkit"
    required
    />

    <label for="description">Description:</label>
    <textarea 
    id="description" 
    name="description"
    placeholder="e.g. Vape startkit"
    required
    ></textarea>
    
    <label for="category_id">Product type:</label>
    <select id="category" name="category_id" required>
        <option value="" disabled selected>Select your option</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}">
                {{ ucfirst($category->name) }}
            </option>
        @endforeach

    </select>

    <label for="price">Price:</label>
    <input
        type="number"
        name="price"
        min="1"
        step="any"
        placeholder="e.g. 10.90 "
        required
    />
    
    <label for="stock">In stock:</label>
    <input
    type="number"
    name="stock"
    placeholder="e.g. 12"
    min="0"
    />



    <label for="brand_id">Brand name:</label>
    <select id="brand" name="brand_id" required>
        <option value="" disabled selected>Select your option</option>
        @foreach ($brands as $brand)
            <option value="{{ $brand->id }}">
                {{ ucfirst($brand->name) }}
            </option>
        @endforeach

    </select>

    <label for="flavor_id">Flavor:</label>
        <select id="flavor_id" name="flavor_id" required>
            <option value="" disabled selected>Select your option</option>
        @foreach ($flavors as $flavor)
            <option value="{{ $flavor->id }}">
                {{ ucfirst($flavor->name) }}
            </option>
        @endforeach

    </select>

    <label for="nicotine_strength_mg">Nicotine strength in mg:</label>
    <input
        type="number"
        name="nicotine_strength_mg"
        min="0"
        placeholder="e.g. 10"
        required
    />

    <label for="volume_ml">Volume in ml:</label>
    <input
        type="number"
        name="volume_ml"
        min="1"
        placeholder="e.g. 25"
        required
    />

    <button type="submit">Add product</button>
</form>

</body>
</html>