@extends('layouts.app')

@section('title', 'Products')
@section('page-title', 'Products')

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
        <div class="stat-value">{{ $products->total() }}</div>
        <div class="stat-sub">products</div>
    </article>
    <article class="stat-card" aria-label="Number of vape units">
        <div class="stat-label">Vape</div>
        <div class="stat-value" style="color:var(--accent2)">{{ $counts['vape'] ?? 0 }}</div>
        <div class="stat-sub">units</div>
    </article>
    <article class="stat-card" aria-label="Number of e-liquids">
        <div class="stat-label">E-liquid</div>
        <div class="stat-value" style="color:var(--green)">{{ $counts['E-liquid'] ?? 0 }}</div>
        <div class="stat-sub">vials</div>
    </article>
    <article class="stat-card" aria-label="Number of nic salts">
        <div class="stat-label">Nic Salt</div>
        <div class="stat-value" style="color:var(--amber)">{{ $counts['Nic Salt'] ?? 0 }}</div>
        <div class="stat-sub">salts</div>
    </article>
</div>

{{-- TABS --}}
<div role="tablist" aria-label="Filter by category" class="tabs">
    <a href="{{ route('products.index') }}"
        class="tab {{ !request('category') ? 'active' : '' }}"
        role="tab"
        aria-selected="{{ !request('category') ? 'true' : 'false' }}">All</a>
    @foreach($categories as $cat)
    <a href="{{ route('products.index', ['category' => $cat->id]) }}"
        class="tab {{ request('category') == $cat->id ? 'active' : '' }}"
        role="tab"
        aria-selected="{{ request('category') == $cat->id ? 'true' : 'false' }}">
        {{ $cat->name }}
    </a>
    @endforeach
</div>

{{-- FILTERS --}}
<section aria-label="Filter products">
    <form method="GET" action="{{ route('products.index') }}" class="filters-bar">
        {{-- Preserve active tab --}}
        @if(request('category'))
        <input type="hidden" name="category" value="{{ request('category') }}">
        @endif

        <div class="filter-group">
            <label for="search" class="filter-label">Search</label>
            <input id="search" type="search" name="search" class="filter-input"
                placeholder="Name, brand..."
                value="{{ request('search') }}"
                style="width:220px">
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
                <input type="number" name="price_min" class="filter-input"
                    placeholder="Min" aria-label="Min price"
                    value="{{ request('price_min') }}" style="width:80px">
                <span aria-hidden="true">–</span>
                <input type="number" name="price_max" class="filter-input"
                    placeholder="Max" aria-label="Max price"
                    value="{{ request('price_max') }}" style="width:80px">
            </div>
        </div>

        <div class="filter-group">
            <label for="stock-filter" class="filter-label">Stock</label>
            <select id="stock-filter" name="stock" class="filter-select">
                <option value="">All</option>
                <option value="in_stock" {{ request('stock') === 'in_stock'  ? 'selected' : '' }}>In stock</option>
                <option value="low_stock" {{ request('stock') === 'low_stock' ? 'selected' : '' }}>Low on stock</option>
                <option value="out" {{ request('stock') === 'out'       ? 'selected' : '' }}>Out of stock</option>
            </select>
        </div>

        <button type="submit" class="btn btn-ghost" style="align-self:flex-end">Filter</button>
        <a href="{{ route('products.index') }}" class="btn btn-ghost" style="align-self:flex-end">✕ Clear</a>
    </form>
</section>

{{-- TABLE --}}
<div class="table-wrap" role="region" aria-label="Product list">
    <table aria-label="Products">
        <thead>
            <tr>
                <th scope="col">Product</th>
                <th scope="col">Category</th>
                <th scope="col">Brand</th>
                <th scope="col">Price</th>
                <th scope="col">Stock</th>
                <th scope="col"><span class="sr-only">Actions</span></th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
            @php
            $stockClass = $product->stock === 0 ? 'stock-out' : ($product->stock < 10 ? 'stock-low' : 'stock-ok' );
                $stockText=$product->stock === 0 ? 'Out of stock' : ($product->stock < 10 ? $product->stock . ' (low)' : $product->stock);
                    $catIcons = ['Vape' => '🌬️', 'E-liquid' => '💧', 'Nic Salt' => '⚗️'];
                    $catBadges = ['Vape' => 'badge-vape', 'E-liquid' => 'badge-eliquid', 'Nic Salt' => 'badge-nicsalt'];
                    $catName = $product->category->name ?? '';
                    @endphp
                    <tr>
                        <td>
                            <div class="product-cell">
                                <div class="product-thumb" aria-hidden="true">
                                    {{ $catIcons[$catName] ?? '📦' }}
                                </div>
                                <div>
                                    <div class="product-name">{{ $product->name }}</div>
                                    <div class="product-sku">{{ $product->brand->name ?? '—' }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge {{ $catBadges[$catName] ?? '' }}">
                                {{ $catName }}
                            </span>
                        </td>
                        <td style="color:var(--text2)">{{ $product->brand->name ?? '—' }}</td>
                        <td>{{ number_format($product->price, 2) }} kr</td>
                        <td class="{{ $stockClass }}" aria-label="Stock: {{ $stockText }}">
                            {{ $stockText }}
                        </td>
                        <td>
                            <div style="display:flex;gap:6px">
                                <a href="{{ route('products.edit', $product) }}"
                                    class="btn btn-ghost btn-sm"
                                    aria-label="Edit {{ $product->name }}">✎ Edit</a>

                                <form action="{{ route('products.destroy', $product) }}" method="POST"
                                    onsubmit="return confirm('Delete {{ addslashes($product->name) }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="btn btn-danger btn-sm"
                                        aria-label="Delete {{ $product->name }}">✕</button>
                                </form>
                            </div>
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
    <nav class="pagination" aria-label="Page navigation">
        <div class="pagination-info" aria-live="polite">
            Showing {{ $products->firstItem() }}–{{ $products->lastItem() }} of {{ $products->total() }} products
        </div>
        <div class="pagination-btns">
            {{ $products->withQueryString()->links('vendor.pagination.simple') }}
        </div>
    </nav>
</div>

@endsection