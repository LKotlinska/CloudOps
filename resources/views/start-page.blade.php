@extends('layouts.app')

@section('title', 'Overview')
@section('page-title', 'Overview of all products')

@section('header-actions')
<a href="{{ route('products.create') }}" class="btn btn-primary">
    + New product
</a>
@endsection

@section('content')

{{-- STATS --}}
<div class="stats-row" role="region" aria-label="Overview">
    <article class="stat-card" aria-label="Total number of products">
        <div class="stat-label">Total</div>
        <div class="stat-value stat-value-total">{{ $products->total() }}</div>
        <div class="stat-sub">products</div>
    </article>
    <article class="stat-card" aria-label="Number of vape units">
        <div class="stat-label">Vape</div>
        <div class="stat-value stat-value-vape">{{ $counts['Vape'] ?? 0 }}</div>
        <div class="stat-sub">units</div>
    </article>
    <article class="stat-card" aria-label="Number of e-liquids">
        <div class="stat-label">E-liquid</div>
        <div class="stat-value stat-value-eliquid">{{ $counts['E-Liquid'] ?? 0 }}</div>
        <div class="stat-sub">vials</div>
    </article>
    <article class="stat-card" aria-label="Number of nic salts">
        <div class="stat-label">Nic Salt</div>
        <div class="stat-value stat-value-nicsalt">{{ $counts['Nicotine salt'] ?? 0 }}</div>
        <div class="stat-sub">salts</div>
    </article>
</div>

{{-- TABS --}}
<div role="tablist" aria-label="Filter by category" class="tabs">
    <a href="{{ route('start-page') }}"
        class="tab {{ !request('category') ? 'active' : '' }}"
        role="tab"
        aria-selected="{{ !request('category') ? 'true' : 'false' }}">All</a>
    @foreach($categories as $cat)
    <a href="{{ route('start-page', ['category' => $cat->id]) }}"
        class="tab {{ request('category') == $cat->id ? 'active' : '' }}"
        role="tab"
        aria-selected="{{ request('category') == $cat->id ? 'true' : 'false' }}">
        {{ $cat->name }}
    </a>
    @endforeach
</div>

{{-- FILTERS --}}
<section aria-label="Filter products">
    <form method="GET" action="{{ route('start-page') }}" class="filters-bar">
        @if(request('category'))
        <input type="hidden" name="category" value="{{ request('category') }}">
        @endif

        <div class="filter-group">
            <label for="search" class="filter-label">Search</label>
            <input id="search"
                type="search"
                name="search"
                class="filter-input filter-input-lg"
                placeholder="Name, brand..."
                value="{{ request('search') }}">
        </div>

        <div class="filter-group">
            <label for="brand-filter" class="filter-label">Brand</label>
            <select id="brand-filter" name="brand" class="filter-select">
                <option value="">All brands</option>
                @foreach($brands as $brand)
                <option value="{{ $brand->id }}" {{ request('brand') == $brand->id ? 'selected' : '' }}>
                    {{ $brand->name }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="filter-group">
            <label class="filter-label">Price</label>
            <div class="price-range">
                <input type="number"
                    name="price_min"
                    class="filter-input filter-input-sm"
                    placeholder="Min"
                    aria-label="Min price"
                    value="{{ request('price_min') }}">
                <span aria-hidden="true">–</span>
                <input type="number"
                    name="price_max"
                    class="filter-input filter-input-sm"
                    placeholder="Max"
                    aria-label="Max price"
                    value="{{ request('price_max') }}">
            </div>
        </div>

        <div class="filter-group">
            <label for="stock-filter" class="filter-label">Stock</label>
            <select id="stock-filter" name="stock" class="filter-select">
                <option value="">All</option>
                <option value="in_stock" {{ request('stock') === 'in_stock' ? 'selected' : '' }}>In stock</option>
                <option value="low_stock" {{ request('stock') === 'low_stock' ? 'selected' : '' }}>Low on stock</option>
                <option value="out" {{ request('stock') === 'out' ? 'selected' : '' }}>Out of stock</option>
            </select>
        </div>

        <div class="filter-group">
            <label for="flavor-filter" class="filter-label">Flavor</label>
            <select id="flavor-filter" name="flavor" class="filter-select">
                <option value="">All flavors</option>
                @foreach($flavors as $flavor)
                <option value="{{ $flavor->id }}" {{ request('flavor') == $flavor->id ? 'selected' : '' }}>
                    {{ $flavor->name }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="filter-group">
            <label for="color-filter" class="filter-label">Color</label>
            <select id="color-filter" name="color" class="filter-select">
                <option value="">All colors</option>
                @foreach($colors as $color)
                <option value="{{ $color->id }}" {{ request('color') == $color->id ? 'selected' : '' }}>
                    {{ $color->name }}
                </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-ghost filter-btn">Filter</button>
        <a href="{{ route('start-page') }}" class="btn btn-ghost filter-btn">✕ Clear</a>
    </form>
</section>

{{-- TABLE --}}
<div class="table-wrap" role="region" aria-label="Product list">
    <table aria-label="Products">
        <thead>
            <tr>
                <th scope="col" class="column-title">Product</th>
                <th scope="col" class="column-title">Category</th>
                <th scope="col" class="column-title">Brand</th>
                <th scope="col" class="column-title">Flavor</th>
                <th scope="col" class="column-title">Color</th>
                <th scope="col" class="column-title">Price</th>
                <th scope="col" class="column-title">Stock</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
            @php
            $stockClass = $product->stock === 0 ? 'stock-out' : ($product->stock < 10 ? 'stock-low' : 'stock-ok' );
                $stockText=$product->stock === 0 ? 'Out of stock' : ($product->stock < 10 ? $product->stock . ' (low)' : $product->stock);
                    $catIcons = ['Vape' => '🌬️', 'E-Liquid' => '💧', 'Nicotine salt' => '⚗️'];
                    $catBadges = ['Vape' => 'badge-vape', 'E-Liquid' => 'badge-eliquid', 'Nicotine salt' => 'badge-nicsalt'];
                    $catName = $product->category->name ?? '';
                    @endphp
                    <tr>
                        <td>
                            <div class="product-cell">
                                <div class="product-thumb" aria-hidden="true">
                                    {{ $catIcons[$catName] ?? '📦' }}
                                </div>
                                <div>
                                    <div class="product-name">{{ ucwords($product->name) }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge {{ $catBadges[$catName] ?? '' }}">
                                {{ $catName }}
                            </span>
                        </td>
                        <td class="text-secondary">{{ $product->brand->name ?? '—' }}</td>
                        <td class="text-secondary">{{ $product->flavors->pluck('name')->join(', ')}}</td>
                        <td class="text-secondary">{{ $product->productVape->color->name ?? '—' }}</td>
                        </td>
                        <td class="text-secondary">{{ number_format($product->price, 2) }} kr</td>
                        <td id="text-sec" class="{{ $stockClass }}" aria-label="Stock: {{ $stockText }}">
                            {{ $stockText }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                <div class="empty-state-icon">📦</div>
                                <div class="empty-state-text">No products found.</div>
                            </div>
                        </td>
                    </tr>
                    @endforelse
        </tbody>
    </table>

    {{-- PAGINATION --}}
    {{ $products->links('partials.pagination') }}
</div>

@endsection