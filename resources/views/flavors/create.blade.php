@extends('layouts.app')

@section('title', 'New Flavor')
@section('page-title', 'New Flavor')

@section('header-actions')
<a href="{{ route('flavors.index') }}" class="btn btn-ghost">← Back to flavors</a>
@endsection

@section('content')

<div class="form-page">
    <div class="form-page-card">
        <p class="form-instructions">Fields marked with an asterisk (*) are mandatory.</p>

        <form action="{{ route('flavors.store') }}" method="POST">
            @csrf

            <div class="form-grid">
                <div class="form-field full">
                    <label for="name">
                        Flavor name <span aria-hidden="true" class="required-mark">*</span>
                    </label>
                    <input id="name"
                        type="text"
                        name="name"
                        class="form-input"
                        value="{{ old('name') }}"
                        required
                        aria-required="true"
                        aria-describedby="name-error"
                        placeholder="e.g. Strawberry">
                    @error('name')
                    <span id="name-error" class="form-error" role="alert">⚠ {{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-page-actions">
                <a href="{{ route('flavors.index') }}" class="btn btn-ghost">Cancel</a>
                <button type="submit" class="btn btn-primary">Save flavor</button>
            </div>
        </form>
    </div>
</div>

@endsection