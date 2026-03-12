@extends('layouts.app')

@section('title', 'Edit Product')
@section('page-title', 'Edit Product')

@section('header-actions')
<a href="{{ route('products.index') }}" class="btn btn-ghost">← Back to products</a>
@endsection

@section('content')

<div class="form-page">
    <div class="form-page-card">
        <p class="form-instructions">
            Fields marked with an asterisk (<span class="required-mark">*</span>) are mandatory.
        </p>

        <form id="add-form" action="{{ route('products.update', $product) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-grid">
                <div class="form-field full">

                    <label for="name">
                        Product name <span class="required-mark">*</span>
                    </label>
                    <input
                        type="text"
                        id="name"
                        class="form-input"
                        name="name"
                        placeholder="e.g. Vape startkit"
                        value="{{ old('name', $product->name) }}"
                        required />

                    <label for="description">Description <span class="required-mark">*</span></label>
                    <textarea
                        id="description"
                        class="form-input"
                        name="description"
                        placeholder="e.g. Vape startkit"
                        required>{{ old('description', $product->description) }}</textarea>

                    <label for="category_id">Product type <span class="required-mark">*</span></label>
                    <select
                        id="category_id"
                        class="form-input"
                        name="category_id"
                        required>

                        <option value="" disabled selected>Select your option</option>

                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ $product->category_id == $category->id ? 'selected' : '' }}>
                            {{ ucfirst($category->name) }}
                        </option>
                        @endforeach

                    </select>

                    <!--  Conditionally rendered fields  -->
                    <div id="vape-fields">

                        <fieldset>
                            <legend>Refillable <span class="required-mark">*</span></legend>

                            <div class="radio-group">
                                <input
                                    type="radio"
                                    id="has_podsystem_yes"
                                    name="has_podsystem"
                                    value="1"
                                    {{ old('has_podsystem', $product->productVape->has_podsystem ?? '') == '1' ? 'checked' : '' }} />
                                <label for="has_podsystem_yes">Yes</label>

                                <input
                                    type="radio"
                                    id="has_podsystem_no"
                                    name="has_podsystem"
                                    value="0"
                                    {{ old('has_podsystem', $product->productVape->has_podsystem ?? '') == '0' ? 'checked' : '' }} />
                                <label for="has_podsystem_no">No</label>
                            </div>
                        </fieldset>

                        <label for="puff_count">Puff count <span class="required-mark">*</span></label>
                        <input
                            type="number"
                            id="puff_count"
                            class="form-input"
                            name="puff_count"
                            min="1"
                            step="1"
                            placeholder="e.g. 1000 "
                            value="{{ old('puff_count', $product->productVape->puff_count ?? '') }}"
                            required />

                        <label for="color_id">Color <span class="required-mark">*</span></label>
                        <select
                            id="color_id"
                            class="form-input"
                            name="color_id"
                            required>

                            <option value="" disabled selected>Select your option</option>

                            @foreach ($colors as $color)
                            <option value="{{ $color->id }}"
                                {{ old('color_id', $product->productVape->color_id ?? '') == $color->id ? 'selected' : '' }}>
                                {{ ucfirst($color->name) }}
                            </option>
                            @endforeach

                        </select>

                    </div>
                    <!------------------------------------->
                    <label for="price">Price <span class="required-mark">*</span></label>
                    <input
                        type="number"
                        id="price"
                        name="price"
                        class="form-input"
                        min="1"
                        step="any"
                        placeholder="e.g. 10.90 "
                        value="{{ old('price', $product->price) }}"
                        required />

                    <label for="stock">In stock <span class="required-mark">*</span></label>
                    <input
                        type="number"
                        id="stock"
                        name="stock"
                        class="form-input"
                        placeholder="e.g. 12"
                        value="{{ old('stock', $product->stock) }}"
                        min="0" />

                    <label for="brand_id">Brand name <span class="required-mark">*</span></label>
                    <select
                        id="brand_id"
                        class="form-input"
                        name="brand_id"
                        required>

                        <option value="" disabled selected>Select your option</option>

                        @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}"
                            {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>
                            {{ ucfirst($brand->name) }}
                        </option>
                        @endforeach

                    </select>

                    <label for="flavor_id">Flavor</label>
                    <select
                        id="flavor_id"
                        class="form-input"
                        name="flavor_id">

                        <option value="" selected>None</option>

                        @foreach ($flavors as $flavor)
                        <option value="{{ $flavor->id }}"
                            {{ (!old('flavor_id') && $product->flavors->contains($flavor->id)) || old('flavor_id') == $flavor->id ? 'selected' : '' }}>
                            {{ ucfirst($flavor->name) }}
                        </option>
                        @endforeach

                    </select>

                    <label for="nicotine_strength_mg">Nicotine strength in mg</label>
                    <input
                        type="number"
                        id="nicotine_strength_mg"
                        class="form-input"
                        name="nicotine_strength_mg"
                        min="0"
                        placeholder="e.g. 10"
                        value="{{ old('nicotine_strength_mg', $product->nicotine_strength_mg) }}" />

                    <label for="volume_ml">Volume in ml</label>
                    <input
                        type="number"
                        id="volume_ml"
                        class="form-input"
                        name="volume_ml"
                        min="1"
                        placeholder="e.g. 25"
                        value="{{ old('volume_ml', $product->volume_ml) }}" />

                </div>
            </div>

            <div class="form-page-actions">
                <a href="{{ route('products.index') }}" class="btn btn-ghost">Cancel</a>
                <button type="submit" class="btn btn-primary">Save product</button>
            </div>
        </form>
    </div>
</div>

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

@endsection