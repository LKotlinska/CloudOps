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
            Fields marked with an asterisk (<span class="required-mark">*</span>) are mandatory.
        </p>

        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <div class="form-grid">
                <div class="form-field full">
                    <label for="name">
                        Category name <span class="required-mark">*</span>
                    </label>
                    <input
                        type="text"
                        id="name"
                        class="form-input"
                        name="name"
                        placeholder="e.g. E-liquid"
                        value="{{ old('name') }}"
                        aria-describedby="name-error"
                        aria-invalid="{{ $errors->has('name') ? 'true' : 'false' }}"
                        required />
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