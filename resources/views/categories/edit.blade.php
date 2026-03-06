@extends('layouts.app')

@section('title', 'Edit Category')
@section('page-title', 'Edit Category')

@section('header-actions')
<a href="{{ route('categories.index') }}" class="btn btn-ghost">← Back to categories</a>
@endsection

@section('content')

<div class="form-page">
    <div class="form-page-card">
        <p class="form-instructions">
            Fields marked with <span aria-hidden="true">*</span>
            <span class="sr-only">asterisk</span> are mandatory.
        </p>

        <form action="{{ route('categories.update', $category) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-grid">
                <div class="form-field full">
                    <label for="name">Category name</label>
                    <input
                        type="text"
                        id="name"
                        class="form-input"
                        name="name"
                        placeholder="e.g. E-liquid"
                        value="{{ $category->name }}"
                        required
                    />
                    @error('name')
                    <span id="name-error" class="form-error" role="alert">⚠ {{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-page-actions">

                <form action="{{ route('categories.destroy', $category) }}" method="POST"
                    onsubmit="return confirm('Delete {{ addslashes($category->name) }}? This cannot be undone.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">✕ Delete category</button>
                </form>

                <div>
                    <a href="{{ route('categories.index') }}" class="btn btn-ghost">Cancel</a>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>

            </div>
        </form>
    </div>
</div>

@endsection
