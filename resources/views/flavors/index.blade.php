@extends('layouts.app')

@section('title', 'Flavors')
@section('page-title', 'Flavors')

@section('header-actions')
<a href="{{ route('flavors.create') }}" class="btn btn-primary">
    + New flavor
</a>
@endsection

@section('content')

<div class="list-table-wrap" role="region" aria-label="Flavor list">
    <table aria-label="Flavors">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Products</th>
                <th scope="col"><span class="sr-only">Actions</span></th>
            </tr>
        </thead>
        <tbody>
            @forelse($flavors as $flavor)
            <tr>
                <td class="text-bold">{{ $flavor->name }}</td>
                <td class="text-secondary">{{ $flavor->products_count }}</td>
                <td>
                    <div class="td-actions">
                        <a href="{{ route('flavors.edit', $flavor) }}"
                            class="btn btn-ghost btn-sm"
                            aria-label="Edit {{ $flavor->name }}">✎ Edit</a>
                        <form action="{{ route('flavors.destroy', $flavor) }}" method="POST"
                            onsubmit="return confirm('Delete {{ addslashes($flavor->name) }}?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="btn btn-danger btn-sm"
                                aria-label="Delete {{ $flavor->name }}">✕</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3">
                    <div class="empty-state">
                        <div class="empty-state-icon">❋</div>
                        <div class="empty-state-text">No flavors found.</div>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection