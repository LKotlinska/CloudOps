@extends('layouts.app')

@section('title', 'Edit Flavor')
@section('page-title', 'Edit Flavor')

@section('header-actions')
<a href="{{ route('flavors.index') }}" class="btn btn-ghost">← Back to flavors</a>
@endsection

@section('content')

<div class="form-page">
    <div class="form-page-card">
        <p class="form-instructions">
            Fields marked with an asterisk (<span class="required-mark">*</span>) are mandatory.
        </p>

        <form id="edit-flavor-form" action="{{ route('flavors.update', $flavor) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-grid">
                <div class="form-field full">
                    <label for="name">
                        Flavor name <span aria-hidden="true" class="required-mark">*</span>
                    </label>
                    <input id="name"
                        type="text"
                        name="name"
                        class="form-input"
                        value="{{ old('name', $flavor->name) }}"
                        required
                        aria-required="true"
                        aria-invalid="{{ $errors->has('name') ? 'true' : 'false' }}"
                        aria-describedby="name-error">
                    @error('name')
                    <span id="name-error" class="form-error" role="alert">⚠ {{ $message }}</span>
                    @enderror
                </div>
            </div>
        </form>

        <form id="delete-flavor-form" action="{{ route('flavors.destroy', $flavor) }}" method="POST"
            onsubmit="return confirm('Delete {{ addslashes($flavor->name) }}? This cannot be undone.')">
            @csrf
            @method('DELETE')
        </form>

        <div class="form-page-actions">
            <div class="d-flex gap-md">
                <a href="{{ route('flavors.index') }}" class="btn btn-ghost">Cancel</a>
                <button type="submit" form="edit-flavor-form" class="btn btn-primary">Save changes</button>
            </div>
            <button type="submit" form="delete-flavor-form" class="btn btn-danger">✕ Delete flavor</button>
        </div>
    </div>
</div>

@endsection