@extends('layouts.app')

@section('title', 'Categories')
@section('page-title', 'Categories')

@section('header-actions')
<a href="{{ route('categories.create') }}" class="btn btn-primary">
    + New category
</a>
@endsection

@section('content')

<div class="table-wrap" role="region" aria-label="Product list">
    <table aria-label="Products">
        <thead>
            <tr>
                <th scope="col">Product</th>
                <th scope="col">Category</th>
                <th scope="col">Brand</th>
                <th scope="col">Price</th>
                <th scope="col">Stock</th>
                <th scope="col">Status</th>
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
                    <tr class="clickable-row" data-href="{{ route('products.show', $product) }}" style="cursor:pointer;">
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
                        <td style="color:var(--color-text-secondary)">{{ $product->brand->name ?? '—' }}</td>
                        <td>{{ number_format($product->price, 2) }} kr</td>
                        <td class="{{ $stockClass }}" aria-label="Stock: {{ $stockText }}">
                            {{ $stockText }}
                        </td>
                        <td>
                            <span style="display:flex;align-items:center;gap:0.375rem;">
                                <span class="status-dot {{ $product->stock > 0 ? 'active' : 'inactive' }}" aria-hidden="true"></span>
                                <span style="color:var(--color-text-secondary)">
                                    {{ $product->stock > 0 ? 'Active' : 'Inactive' }}
                                </span>
                            </span>
                        </td>
                        <td>
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
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7">
                            <div class="empty-state">
                                <div class="empty-state-icon">📦</div>
                                <div class="empty-state-text">No products found.</div>
                            </div>
                        </td>
                    </tr>
                    @endforelse
        </tbody>
    </table>
</div>

<script>
    document.querySelectorAll('.clickable-row').forEach(row => {
        row.addEventListener('click', e => {
            if (!e.target.closest('a, button, form')) {
                window.location = row.dataset.href;
            }
        });
    });
</script>

@endsection
