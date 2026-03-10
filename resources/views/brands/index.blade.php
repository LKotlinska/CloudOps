@extends('layouts.app')

@section('title', 'Brands')
@section('page-title', 'Brands')

@section('header-actions')
<a href="{{ route('brands.create') }}" class="btn btn-primary">
    + New brand
</a>
@endsection

@section('content')

<div class="list-table-wrap" role="region" aria-label="Brand list">
    <table aria-label="Brands">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col" class="column-title">Amount</th>
                <th scope="col"><span class="sr-only">Actions</span></th>
            </tr>
        </thead>
        <tbody>
            @forelse($brands as $brand)
            <tr>
                <td class="text-bold">{{ $brand->name }}</td>
                <td class="text-secondary">{{ $brand->products_count }}</td>
                <td>
                    <div class="td-actions">
                        <a href="{{ route('brands.edit', $brand) }}"
                            class="btn btn-ghost btn-sm"
                            aria-label="Edit {{ $brand->name }}">✎ Edit</a>
                        <form action="{{ route('brands.destroy', $brand) }}" method="POST"
                            onsubmit="return confirm('Delete {{ addslashes($brand->name) }}?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="btn btn-danger btn-sm"
                                aria-label="Delete {{ $brand->name }}">✕</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3">
                    <div class="empty-state">
                        <div class="empty-state-icon">◉</div>
                        <div class="empty-state-text">No brands found.</div>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{ $brands->links('partials.pagination') }}

</div>

@endsection