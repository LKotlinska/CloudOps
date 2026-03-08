@extends('layouts.app')

@section('title', 'Edit Brand')
@section('page-title', 'Edit Brand')

@section('header-actions')
<a href="{{ route('brands.index') }}" class="btn btn-ghost">← Back to brands</a>
@endsection

@section('content')

<div class="form-page">
    <div class="form-page-card">
        <p class="form-instructions">Fields marked with an asterisk (*) are mandatory.</p>

        <form action="{{ route('brands.update', $brand) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-grid">
                <div class="form-field full">
                    <label for="name">
                        Brand name <span aria-hidden="true" class="required-mark">*</span>
                    </label>
                    <input id="name"
                        type="text"
                        name="name"
                        class="form-input"
                        value="{{ old('name', $brand->name) }}"
                        required
                        aria-required="true"
                        aria-describedby="name-error">
                    @error('name')
                    <span id="name-error" class="form-error" role="alert">⚠ {{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-page-actions">
                <form action="{{ route('brands.destroy', $brand) }}" method="POST"
                    onsubmit="return confirm('Delete {{ addslashes($brand->name) }}? This cannot be undone.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">✕ Delete brand</button>
                </form>

                <div class="d-flex gap-md">
                    <a href="{{ route('brands.index') }}" class="btn btn-ghost">Cancel</a>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection