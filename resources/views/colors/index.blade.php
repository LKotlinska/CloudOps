@extends('layouts.app')

@section('title', 'Colors')
@section('page-title', 'Colors')

@section('header-actions')
<a href="{{ route('colors.create') }}" class="btn btn-primary">
    + New color
</a>
@endsection

@section('content')

<div class="list-table-wrap" role="region" aria-label="Color list">
    <table aria-label="Colors">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col" class="column-title">Amount</th>
                <th scope="col"><span class="sr-only">Actions</span></th>
            </tr>
        </thead>
        <tbody>
            @forelse($colors as $color)
            <tr>
                <td class="text-bold">{{ $color->name }}</td>
                <td class="text-secondary">{{ $color->product_vapes_count }}</td>
                <td>
                    <div class="td-actions">
                        <a href="{{ route('colors.edit', $color) }}"
                            class="btn btn-ghost btn-sm"
                            aria-label="Edit {{ $color->name }}">✎ Edit</a>
                        <form action="{{ route('colors.destroy', $color) }}" method="POST"
                            onsubmit="return confirm('Delete {{ addslashes($color->name) }}?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="btn btn-danger btn-sm"
                                aria-label="Delete {{ $color->name }}">✕</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3">
                    <div class="empty-state">
                        <div class="empty-state-icon">◈</div>
                        <div class="empty-state-text">No colors found.</div>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{ $colors->links('partials.pagination') }}

</div>

@endsection