<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CloudOps — @yield('title', 'Dashboard')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=Syne:wght@400;600;700;800&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('css/start-page.css') }}">
    @yield('styles')
</head>

<body>

    <!-- SIDEBAR -->
    <aside aria-label="Main menu">
        <a href="{{ route('start-page') }}" class="logo">
            <div class="logo-mark">CloudOps</div>
            <div class="logo-sub">Product management</div>
        </a>
        <nav>
            <div class="nav-section">Catalogue</div>
            <a href="{{ route('start-page') }}"
                class="nav-item {{ request()->routeIs('start-page') ? 'active' : '' }}"
                aria-current="{{ request()->routeIs('start-page') ? 'page' : 'false' }}">
                <span class="nav-icon" aria-hidden="true">▦</span> Overview
            </a>
            <a href="{{ route('products.index') }}"
                class="nav-item {{ request()->routeIs('products.*') ? 'active' : '' }}"
                aria-current="{{ request()->routeIs('products.*') ? 'page' : 'false' }}">
                <span class="nav-icon" aria-hidden="true">▣</span> Products
            </a>
            <a href="{{ route('categories.index') }}"
                class="nav-item {{ request()->routeIs('categories.*') ? 'active' : '' }}"
                aria-current="{{ request()->routeIs('categories.*') ? 'page' : 'false' }}">
                <span class="nav-icon" aria-hidden="true">◈</span> Categories
            </a>
            <a href="{{ route('brands.index') }}"
                class="nav-item {{ request()->routeIs('brands.*') ? 'active' : '' }}"
                aria-current="{{ request()->routeIs('brands.*') ? 'page' : 'false' }}">
                <span class="nav-icon" aria-hidden="true">◉</span> Brands
            </a>
            <a href="{{ route('flavors.index') }}"
                class="nav-item {{ request()->routeIs('flavors.*') ? 'active' : '' }}"
                aria-current="{{ request()->routeIs('flavors.*') ? 'page' : 'false' }}">
                <span class="nav-icon" aria-hidden="true">❋</span> Flavors
            </a>
            <a href="{{ route('colors.index') }}"
                class="nav-item {{ request()->routeIs('colors.*') ? 'active' : '' }}"
                aria-current="{{ request()->routeIs('colors.*') ? 'page' : 'false' }}">
                <span class="nav-icon" aria-hidden="true">◍</span> Colors
            </a>
            <div class="nav-section">Account</div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="nav-item nav-logout">
                    <span class="nav-icon" aria-hidden="true">→</span> Logout
                </button>
            </form>
        </nav>
    </aside>
    <div class="main-container">

    <!-- TOPBAR -->
    <header>
        <h1 class="page-title">@yield('page-title', 'Dashboard')</h1>
        <div class="header-actions">
            @yield('header-actions')
        </div>
    </header>

    <!-- MAIN -->
    <main id="main-content">

        <div class="content">

            {{-- Flash messages --}}
            @if(session('success'))
            <div class="alert alert-success" role="alert">
                ✓ {{ session('success') }}
            </div>
            @endif
            @if(session('error'))
            <div class="alert alert-error" role="alert">
                ⚠ {{ session('error') }}
            </div>
            @endif

            @yield('content')
        </div>

    </main>
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')

</body>
</html>