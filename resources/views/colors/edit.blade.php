@extends('layouts.app')

@section('title', 'Edit Color')
@section('page-title', 'Edit Color')

@section('header-actions')
<a href="{{ route('colors.index') }}" class="btn btn-ghost">← Back to colors</a>
@endsection

@section('content')

<div class="form-page">
    <div class="form-page-card">
        <p class="form-instructions">
            Fields marked with an asterisk (<span class="required-mark">*</span>) are mandatory.
        </p>

        <form id="edit-color-form" action="{{ route('colors.update', $color) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-grid">
                <div class="form-field full">
                    <label for="name">
                        Color name <span aria-hidden="true" class="required-mark">*</span>
                    </label>
                    <input id="name"
                        type="text"
                        name="name"
                        class="form-input"
                        value="{{ old('name', $color->name) }}"
                        required
                        aria-required="true"
                        aria-describedby="name-error">
                    @error('name')
                    <span id="name-error" class="form-error" role="alert">⚠ {{ $message }}</span>
                    @enderror
                </div>
            </div>
        </form>

        <form id="delete-color-form" action="{{ route('colors.destroy', $color) }}" method="POST"
            onsubmit="return confirm('Delete {{ addslashes($color->name) }}? This cannot be undone.')">
            @csrf
            @method('DELETE')
        </form>

        <div class="form-page-actions">
            <div class="d-flex gap-md">
                <a href="{{ route('colors.index') }}" class="btn btn-ghost">Cancel</a>
                <button type="submit" form="edit-color-form" class="btn btn-primary">Save changes</button>
            </div>
            <button type="submit" form="delete-color-form" class="btn btn-danger">✕ Delete color</button>
        </div>
    </div>
</div>

@endsection