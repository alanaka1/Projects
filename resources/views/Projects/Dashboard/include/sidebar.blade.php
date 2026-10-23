@php
    $authOpen = request()->routeIs('users.*') || $authOpen = request()->routeIs('roles.*');
@endphp
<aside class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <a href="#" class="brand-link">
        <span class="brand-icon"><i class="fa-solid fa-layer-group"></i></span>
        <span class="brand-text">AdminPro</span>
        </a>
        <button class="btn sidebar-close d-lg-none" id="sidebarClose" type="button"><i class="fa-solid fa-xmark"></i></button>
    </div>

    @auth
        <div class="sidebar-user">
            @if(auth()->user()->image)
                <img src="{{ asset(auth()->user()->image) }}" alt="{{ auth()->user()->name }}" class="user-avatar" style="object-fit:cover;">
            @else
                <div class="user-avatar bg-light d-flex align-items-center justify-content-center">
                    <i class="fa-solid fa-user {{ auth()->user()->gender === 'female' ? 'text-danger' : 'text-primary' }}"></i>
                </div>
            @endif
            <div class="user-info">
                <strong>{{ auth()->user()->name }} {{ auth()->user()->surname }}</strong>
                <span>{{ auth()->user()->hasRole('admin') ? __('Auth/users.modules.admin') : __('Auth/users.modules.user') }}</span>
            </div>
        </div>
    @endauth

    <nav class="sidebar-nav">
        <div class="nav-section-title">@lang('All.main')</div>
        <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"><i class="fa-solid fa-house"></i><span>@lang('All.dashboard')</span></a>
        <!-- <a href="#" class="sidebar-link"><i class="fa-solid fa-chart-line"></i><span>Analytics</span></a> -->

        <button class="sidebar-link sidebar-dropdown-toggle {{ $authOpen ? 'active' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#AuthenticationMenu" aria-expanded="{{ $authOpen ? 'true' : 'false' }}">
            <!-- data-bs-target="#AuthenticationMenu" -->
            <span class="d-flex align-items-center gap-3">
                <i class="fa-solid fa-user-lock"></i>
                <span class="">@lang('All.authentication')</span>
            </span>
            <i class="fa-solid fa-chevron-down submenu-arrow"></i>
        </button>
        <div class="collapse sidebar-submenu {{ $authOpen ? 'show' : '' }}" id="AuthenticationMenu">
            <!-- id="AuthenticationMenu" -->
            <a href="{{ route('users.index') }}" class="sidebar-link {{ request()->routeIs('users.*') ? 'active' : '' }}"><i class="fa-solid fa-user"></i><span class="ms-2">@lang('Auth/users.title')</span></a>
            <a href="{{ route('roles.index') }}" class="sidebar-link {{ request()->routeIs('roles.*') ? 'active' : '' }}"><i class="fa-solid fa-user"></i><span class="ms-2">@lang('Auth/roles.title')</span></a>
        </div>


        <button class="sidebar-link sidebar-dropdown-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#productsMenu" aria-expanded="false">
        <!-- data-bs-target="#productsMenu" -->
        <span class="d-flex align-items-center gap-3"><i class="fa-solid fa-cart-shopping"></i><span>Products</span></span>
        <i class="fa-solid fa-chevron-down submenu-arrow"></i>
        </button>
        <div class="collapse sidebar-submenu" id="productsMenu">
        <!-- id="productsMenu" -->
        <a href="#">All Products</a>
        <a href="#">Pending Products</a>
        <a href="#">Completed</a>
        </div>

        <div class="nav-section-title mt-3">MANAGEMENT</div>
        <a href="#" class="sidebar-link"><i class="fa-solid fa-users"></i><span>Customers</span></a>
        <a href="#" class="sidebar-link"><i class="fa-solid fa-box-open"></i><span>Products</span></a>
        <a href="#" class="sidebar-link"><i class="fa-solid fa-file-invoice-dollar"></i><span>Invoices</span></a>
        <a href="#" class="sidebar-link"><i class="fa-solid fa-gear"></i><span>Settings</span></a>
    </nav>
</aside>