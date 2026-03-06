@extends('layouts.app')

@section('title', 'New Category')
@section('page-title', 'New Category')

@section('header-actions')
<a href="{{ route('categories.index') }}" class="btn btn-ghost">← Back to categories</a>
@endsection

@section('content')

<div class="form-page">
    <div class="form-page-card">
        <p class="form-instructions">
            Fields marked with <span aria-hidden="true" style="color:var(--red)">*</span>
            <span class="sr-only">asterisk</span> are mandatory.
        </p>

        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <div class="form-grid">
                <div class="form-field full">
                    <label for="name">Category name</label>
                    <input
                        type="text" 
                        id="name"
                        class="form-input"
                        name="name"
                        placeholder="e.g. E-liquid"
                        value="{{ old('name') }}"
                        required
                    />
                    @error('name')
                        <span id="name-error" class="form-error" role="alert">⚠ {{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-page-actions">
                <a href="{{ route('categories.index') }}" class="btn btn-ghost">Cancel</a>
                <button type="submit" class="btn btn-primary">Save category</button>
            </div>

        </form>
    </div>
</div>

@endsection