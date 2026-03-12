@extends('layouts.app')

@section('title', 'Products')
@section('page-title', 'Products')

@section('header-actions')
<a href="{{ route('products.create') }}" class="btn btn-primary">
    + New product
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
                    $catIcons = ['Vape' => '🌬️', 'E-Liquid' => '💧', 'Nicotine salt' => '⚗️'];
                    $catBadges = ['Vape' => 'badge-vape', 'E-Liquid' => 'badge-eliquid', 'Nicotine salt' => 'badge-nicsalt'];
                    $catName = $product->category->name ?? '';
                    @endphp
                    <tr class="clickable-row">
                        <td>
                            <a href="{{ route('products.show', $product) }}" class="row-link" aria-label="View {{ ucwords($product->name) }}"></a>
                            <div class="product-name">{{ ucwords($product->name) }}</div>
                        </td>
                        <td>
                            <span class="badge {{ $catBadges[$catName] ?? '' }}">
                                {{ $catName }}
                            </span>
                        </td>
                        <td>{{ $product->brand->name ?? '—' }}</td>
                        <td>{{ number_format($product->price, 2) }} kr</td>
                        <td class="{{ $stockClass }}" aria-label="Stock: {{ $stockText }}">
                            {{ $stockText }}
                        </td>
                        <td>
                            <span>
                                <span class="status-dot {{ $product->stock > 0 ? 'active' : 'inactive' }}" aria-hidden="true"></span>
                                <span>
                                    {{ $product->stock > 0 ? 'Active' : 'Inactive' }}
                                </span>
                            </span>
                        </td>
                        <td>
                            <div class="td-actions">
                                <a href="{{ route('products.show', $product) }}"
                                    class="btn btn-ghost btn-sm"
                                    aria-label="View {{ ucwords($product->name) }}">👁 View</a>

                                <a href="{{ route('products.edit', $product) }}"
                                    class="btn btn-ghost btn-sm"
                                    aria-label="Edit {{ ucwords($product->name) }}">✎ Edit</a>
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

    {{ $products->links('partials.pagination') }}
    
</div>


@endsection
