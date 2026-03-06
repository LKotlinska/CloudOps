@extends('layouts.app')

@section('title', $product->name)
@section('page-title', $product->name)

@section('header-actions')
<a href="{{ route('products.index') }}" class="btn btn-ghost">← Back to products</a>
<a href="{{ route('products.edit', $product) }}" class="btn btn-ghost">✎ Edit</a>
<form action="{{ route('products.destroy', $product) }}" method="POST"
    onsubmit="return confirm('Delete {{ addslashes($product->name) }}?')">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm">✕ Delete</button>
</form>
@endsection

@section('content')

@php
    $catName = $product->category->name ?? '';
    $catBadges = ['Vape' => 'badge-vape', 'E-liquid' => 'badge-eliquid', 'Nic Salt' => 'badge-nicsalt'];
    $catIcons  = ['Vape' => '🌬️', 'E-liquid' => '💧', 'Nic Salt' => '⚗️'];
@endphp

<div class="form-page">
    <div class="form-page-card">
        <div class="table-wrap">
            <table>
                <tbody>

                    <tr>
                        <th scope="row">Product name</th>
                        <td>{{ $product->name }}</td>
                    </tr>

                    <tr>
                        <th scope="row">Description</th>
                        <td>{{ $product->description }}</td>
                    </tr>

                    <tr>
                        <th scope="row">Product type</th>
                        <td>
                            <span class="badge {{ $catBadges[$catName] ?? '' }}">
                                {{ $catIcons[$catName] ?? '📦' }} {{ $catName }}
                            </span>
                        </td>
                    </tr>

                    @if(strtolower($catName) === 'vape')
                    <tr>
                        <th scope="row">Refillable</th>
                        <td>{{ $product->productVape?->has_podsystem ? 'Yes' : 'No' }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Puff count</th>
                        <td>{{ $product->productVape?->puff_count }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Color</th>
                        <td>{{ ucfirst($product->productVape?->color?->name ?? '—') }}</td>
                    </tr>
                    @endif

                    <tr>
                        <th scope="row">Price</th>
                        <td>{{ number_format($product->price, 2) }} kr</td>
                    </tr>

                    <tr>
                        <th scope="row">In stock</th>
                        <td>
                            <span style="display:flex;align-items:center;gap:0.375rem;">
                                <span class="status-dot {{ $product->stock > 0 ? 'active' : 'inactive' }}" aria-hidden="true"></span>
                                {{ $product->stock }}
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <th scope="row">Brand</th>
                        <td>{{ $product->brand->name ?? '—' }}</td>
                    </tr>

                    <tr>
                        <th scope="row">Flavor</th>
                        <td>
                            <div class="chip-wrap">
                                @foreach($product->flavors as $flavor)
                                    <span class="chip flavor-chip">{{ ucfirst($flavor->name) }}</span>
                                @endforeach
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <th scope="row">Nicotine strength</th>
                        <td>{{ $product->nicotine_strength_mg }} mg</td>
                    </tr>

                    <tr>
                        <th scope="row">Volume</th>
                        <td>{{ $product->volume_ml }} ml</td>
                    </tr>

                </tbody>
            </table>

        </div>
        <div class="form-page-actions product-view">
            <form action="{{ route('products.destroy', $product) }}" method="POST"
                onsubmit="return confirm('Delete {{ addslashes($product->name) }}? This cannot be undone.')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">✕ Delete product</button>
            </form>

            <a href="{{ route('products.edit', $product) }}"
                class="btn btn-ghost btn-sm"
                aria-label="Edit {{ $product->name }}">✎ Edit</a>
        </div>
    </div>
</div>

@endsection
