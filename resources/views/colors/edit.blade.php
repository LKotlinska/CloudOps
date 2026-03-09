@extends('layouts.app')

@section('title', 'Edit Color')
@section('page-title', 'Edit Color')

@section('header-actions')
<a href="{{ route('colors.index') }}" class="btn btn-ghost">← Back to colors</a>
@endsection

@section('content')

<div class="form-page">
    <div class="form-page-card">
        <p class="form-instructions">Fields marked with an asterisk (*) are mandatory.</p>

        <form action="{{ route('colors.update', $color) }}" method="POST">
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

            <div class="form-page-actions">
                <div class="d-flex gap-md">
                    <a href="{{ route('colors.index') }}" class="btn btn-ghost">Cancel</a>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </form>
        <form action="{{ route('colors.destroy', $color) }}" method="POST"
            onsubmit="return confirm('Delete {{ addslashes($color->name) }}? This cannot be undone.')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">✕ Delete color</button>
        </form>
    </div>
</div>

@endsection