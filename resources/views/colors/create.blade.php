@extends('layouts.app')

@section('title', 'New Color')
@section('page-title', 'New Color')

@section('header-actions')
<a href="{{ route('colors.index') }}" class="btn btn-ghost">← Back to colors</a>
@endsection

@section('content')

<div class="form-page">
    <div class="form-page-card">
        <p class="form-instructions">
            Fields marked with <span aria-hidden="true" style="color:var(--red)">*</span>
            <span class="sr-only">asterisk</span> are mandatory.
        </p>

        <form action="{{ route('colors.store') }}" method="POST">
            @csrf

            <div class="form-grid">
                <div class="form-field full">
                    <label for="name">
                        Color name <span aria-hidden="true" style="color:var(--red)">*</span>
                    </label>
                    <input id="name"
                        type="text"
                        name="name"
                        class="form-input"
                        value="{{ old('name') }}"
                        required
                        aria-required="true"
                        aria-describedby="name-error"
                        placeholder="e.g. Midnight Black">
                    @error('name')
                    <span id="name-error" class="form-error" role="alert">⚠ {{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-page-actions">
                <a href="{{ route('colors.index') }}" class="btn btn-ghost">Cancel</a>
                <button type="submit" class="btn btn-primary">Save color</button>
            </div>
        </form>
    </div>
</div>

@endsection