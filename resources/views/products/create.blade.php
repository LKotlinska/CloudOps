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
    
    <label for="name">Product name *</label>
    <input 
        type="text" 
        id="name" 
        name="name"
        placeholder="e.g. Vape startkit"
        value="{{ old('name') }}"
        required
    />

    <label for="description">Description *</label>
    <textarea 
        id="description" 
        name="description"
        placeholder="e.g. Vape startkit"
        required
    >{{ old('description') }}</textarea>
    
    <label for="category_id">Product type *</label>
    <select 
        id="category_id" 
        name="category_id" 
        required>

        <option value="" disabled selected>Select your option</option>

        @foreach ($categories as $category)
            <option value="{{ $category->id }}"
                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                {{ ucfirst($category->name) }}
            </option>
        @endforeach

    </select>

    <!--  Conditionally rendered fields  -->
    <div id="vape-fields">

        <label>Refillable *</label>

        <input 
            type="radio"
            id="has_podsystem_yes"
            name="has_podsystem"
            value="1"
            {{ old('has_podsystem') == '0' ? 'checked' : '' }}
        />
        <label for="has_podsystem_yes">Yes</label>

        <input 
            type="radio"
            id="has_podsystem_no"
            name="has_podsystem"
            value="0"
            {{ old('has_podsystem') == '1' ? 'checked' : '' }}
        />
        <label for="has_podsystem_no">No</label>

        <label for="puff_count">Puff count *</label>
        <input
            type="number"
            id="puff_count"
            name="puff_count"
            min="1"
            step="1"
            placeholder="e.g. 1000 "
            value="{{ old('puff_count') }}"
            required
        />

        <label for="color">Color *</label>
        <select
            id="color_id"
            name="color_id"
            required>
            
            <option value="" disabled selected>Select your option</option>

            @foreach ($colors as $color)
                <option value="{{ $color->id }}"
                    {{ old('color_id') == $color->id ? 'selected' : '' }}>
                    {{ ucfirst($color->name) }}
                </option>
            @endforeach

        </select>

    </div>
    <!------------------------------------->
    <label for="price">Price *</label>
    <input
        type="number"
        name="price"
        min="1"
        step="any"
        placeholder="e.g. 10.90 "
        value="{{ old('price') }}"
        required
    />
    
    <label for="stock">In stock *</label>
    <input
        type="number"
        name="stock"
        placeholder="e.g. 12"
        value="{{ old('stock') }}"
        min="0"
    />

    <label for="brand_id">Brand name *</label>
    <select 
        id="brand_id" 
        name="brand_id" 
        required>

        <option value="" disabled selected>Select your option</option>

        @foreach ($brands as $brand)
            <option value="{{ $brand->id }}"
                {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                {{ ucfirst($brand->name) }}
            </option>
        @endforeach

    </select>

    <label for="flavor_id">Flavor *</label>
    <select 
        id="flavor_id" 
        name="flavor_id" 
        required>

        <option value="" disabled selected>Select your option</option>

        @foreach ($flavors as $flavor)
            <option value="{{ $flavor->id }}"
                {{ old('flavor_id') == $flavor->id ? 'selected' : '' }}>
                {{ ucfirst($flavor->name) }}
            </option>
        @endforeach

    </select>

    <label for="nicotine_strength_mg">Nicotine strength in mg *</label>
    <input
        type="number"
        name="nicotine_strength_mg"
        min="0"
        placeholder="e.g. 10"
        value="{{ old('nicotine_strength_mg') }}"
        required
    />

    <label for="volume_ml">Volume in ml *</label>
    <input
        type="number"
        name="volume_ml"
        min="1"
        placeholder="e.g. 25"
        value="{{ old('volume_ml') }}"
        required
    />

    <button type="submit">Add product</button>
</form>

<script>
    document.addEventListener('DOMContentLoaded', () => {
    const select = document.getElementById('category_id');

    select.addEventListener('change', toggleVapeFields);
    
    toggleVapeFields();
});

    function toggleVapeFields() {
        const select = document.getElementById('category_id');
        const selected = select.options[select.selectedIndex].text.toLowerCase();
        const vapeFields = document.getElementById('vape-fields');
        const isVape = selected === 'vape';

        vapeFields.style.display = isVape ? 'block' : 'none';

        // Fields need to be disabled, so we don't send them when category isn't vape
        vapeFields.querySelectorAll('input, select').forEach(field => {
            field.disabled = isVape ? false : true;
        });

    }
</script>

</body>
</html>