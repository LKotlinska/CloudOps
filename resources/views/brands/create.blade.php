@extends('layouts.app')

@section('title', 'New Brand')
@section('page-title', 'New Brand')

@section('header-actions')
<a href="{{ route('brands.index') }}" class="btn btn-ghost">← Back to brands</a>
@endsection

@section('content')

<div class="form-page">
    <div class="form-page-card">
        <p class="form-instructions">Fields marked with an asterisk (*) are mandatory.</p>

        <form action="{{ route('brands.store') }}" method="POST">
            @csrf

            <div class="form-grid">
                <div class="form-field full">
                    <label for="name">
                        Brand name <span aria-hidden="true" class="required-mark">*</span>
                    </label>
                    <input id="name"
                        type="text"
                        name="name"
                        class="form-input"
                        value="{{ old('name') }}"
                        required
                        aria-required="true"
                        aria-describedby="name-error"
                        placeholder="e.g. Vaporesso">
                    @error('name')
                    <span id="name-error" class="form-error" role="alert">⚠ {{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-page-actions">
                <a href="{{ route('brands.index') }}" class="btn btn-ghost">Cancel</a>
                <button type="submit" class="btn btn-primary">Save brand</button>
            </div>
        </form>
    </div>
</div>

@endsection