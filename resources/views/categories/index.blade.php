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
                <th scope="col" class="column-title">Amount</th>
                <th scope="col"><span class="sr-only">Actions</span></th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
            <tr>
                <td class="text-bold">{{ $category->name }}</td>
                <td class="text-secondary">{{ $category->products_count }}</td>
                <td>
                    <div class="td-actions">
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
                        <div class="empty-state-text">No categories found.</div>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{ $categories->links('partials.pagination') }}

</div>

@endsection