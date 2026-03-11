@extends('layouts.app')

@section('title', 'New Product')
@section('page-title', 'New Product')

@section('header-actions')
<a href="{{ route('products.index') }}" class="btn btn-ghost">← Back to products</a>
@endsection

@section('content')

<div class="form-page">
    <div class="form-page-card">
        <p class="form-instructions">
            Fields marked with <span aria-hidden="true">*</span>
            <span class="sr-only">asterisk</span> are mandatory.
        </p>

        <form id="add-form" action="{{ route('products.store') }}" method="POST">
            @csrf
            
            <div class="form-grid">
                <div class="form-field full">

                    <label for="name">Product name *</label>
                    <input 
                        type="text" 
                        id="name"
                        class="form-input"
                        name="name"
                        placeholder="e.g. Vape startkit"
                        value="{{ old('name') }}"
                        required
                    />

                    @error('name')
                    <span id="name-error" class="form-error" role="alert">⚠ {{ $message }}</span>
                    @enderror

                    <label for="description">Description *</label>
                    <textarea 
                        id="description"
                        class="form-input"
                        name="description"
                        placeholder="e.g. Vape startkit"
                        required
                    >{{ old('description') }}</textarea>
                    
                    @error('description')
                        <span id="description-error" class="form-error" role="alert">⚠ {{ $message }}</span>
                    @enderror

                    <label for="category_id">Product type *</label>
                    <select 
                        id="category_id"
                        class="form-input"
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

                    @error('category_id')
                        <span id="category-error" class="form-error" role="alert">⚠ {{ $message }}</span>
                    @enderror

                    <!--  Conditionally rendered fields  -->
                    <div id="vape-fields">

                        <label for="has_podsystem">Refillable *</label>

                        <input 
                            type="radio"
                            id="has_podsystem_yes"
                            class="form-input"
                            name="has_podsystem"
                            value="1"
                            {{ old('has_podsystem') == '1' ? 'checked' : '' }}
                        />
                        <label for="has_podsystem_yes">Yes</label>

                        <input
                            type="radio"
                            id="has_podsystem_no"
                            class="form-input"
                            name="has_podsystem"
                            value="0"
                            {{ old('has_podsystem') == '0' ? 'checked' : '' }}
                        />
                        <label for="has_podsystem_no">No</label>

                        @error('has_podsystem')
                            <span id="has_podsystem-error" class="form-error" role="alert">⚠ {{ $message }}</span>
                        @enderror

                        <label for="puff_count">Puff count *</label>
                        <input
                            type="number"
                            id="puff_count"
                            class="form-input"
                            name="puff_count"
                            min="1"
                            step="1"
                            placeholder="e.g. 1000 "
                            value="{{ old('puff_count') }}"
                            required
                        />

                        @error('puff_count')
                            <span id="puff_count-error" class="form-error" role="alert">⚠ {{ $message }}</span>
                        @enderror

                        <label for="color">Color *</label>
                        <select
                            id="color_id"
                            class="form-input"
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

                        @error('color_id')
                            <span id="color-error" class="form-error" role="alert">⚠ {{ $message }}</span>
                        @enderror

                    </div>
                    <!------------------------------------->
                    <label for="price">Price *</label>
                    <input
                        type="number"
                        id="price"
                        class="form-input"
                        name="price"
                        min="1"
                        step="any"
                        placeholder="e.g. 10.90 "
                        value="{{ old('price') }}"
                        required
                    />
                    
                    @error('price')
                        <span id="price-error" class="form-error" role="alert">⚠ {{ $message }}</span>
                    @enderror

                    <label for="stock">In stock *</label>
                    <input
                        type="number"
                        id="stock"
                        class="form-input"
                        name="stock"
                        placeholder="e.g. 12"
                        value="{{ old('stock') }}"
                        min="0"
                    />

                    @error('stock')
                        <span id="stock-error" class="form-error" role="alert">⚠ {{ $message }}</span>
                    @enderror

                    <label for="brand_id">Brand name *</label>
                    <select 
                        id="brand_id"
                        class="form-input"
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

                    @error('brand_id')
                        <span id="brand-error" class="form-error" role="alert">⚠ {{ $message }}</span>
                    @enderror         

                    <label for="flavor_id">Flavor</label>
                    <select 
                        id="flavor_id"
                        class="form-input"
                        name="flavor_id" 
                        >

                        <option value="" selected>None</option>

                        @foreach ($flavors as $flavor)
                            <option value="{{ $flavor->id }}"
                                {{ old('flavor_id') == $flavor->id ? 'selected' : '' }}>
                                {{ ucfirst($flavor->name) }}
                            </option>
                        @endforeach
                    </select>

                    @error('flavor_id')
                        <span id="flavor-error" class="form-error" role="alert">⚠ {{ $message }}</span>
                    @enderror

                    <label for="nicotine_strength_mg">Nicotine strength in mg</label>
                    <input
                        type="number"
                        id="nicotine_strength_mg"
                        class="form-input"
                        name="nicotine_strength_mg"
                        min="0"
                        placeholder="e.g. 10"
                        value="{{ old('nicotine_strength_mg') }}"
                    />

                    @error('nicotine_strength_mg')
                        <span id="nicotine_strength-error" class="form-error" role="alert">⚠ {{ $message }}</span>
                    @enderror

                    <label for="volume_ml">Volume in ml</label>
                    <input
                        type="number"
                        id="volume_ml"
                        class="form-input"
                        name="volume_ml"
                        min="1"
                        placeholder="e.g. 25"
                        value="{{ old('volume_ml') }}"
                    />

                    @error('volume_ml')
                        <span id="volume-error" class="form-error" role="alert">⚠ {{ $message }}</span>
                    @enderror

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