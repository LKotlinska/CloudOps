@extends('layouts.app')

@section('title', 'Categories')
@section('page-title', 'Categories')

@section('header-actions')
<a href="{{ route('categories.create') }}" class="btn btn-primary">
    + New category
</a>
@endsection

@section('content')

<div class="list-table-wrap" role="region" aria-label="Category list">
    <table aria-label="Categories">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Products</th>
                <th scope="col"><span class="sr-only">Actions</span></th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
            <tr>
                <td>{{ $category->name }}</td>
                <td>{{ $category->products_count }}</td>
                <td>
                    <div>
                        <a href="{{ route('categories.edit', $category) }}"
                            class="btn btn-ghost btn-sm"
                            aria-label="Edit {{ $category->name }}">✎ Edit</a>

                        <form action="{{ route('categories.destroy', $category) }}" method="POST"
                            onsubmit="return confirm('Delete {{ addslashes($category->name) }}?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="btn btn-danger btn-sm"
                                aria-label="Delete {{ $category->name }}">✕</button>
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
</div>

@endsection