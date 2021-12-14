<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard.home') }}" class="brand-link">
        <img src="{{ asset('img/pos-logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">{{ __('site.point_of_sale') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="pb-3 mt-3 mb-3 user-panel d-flex">
        <div class="image">
            <img src="{{ asset('uploads/user-images/' . auth()->user()->image) }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="#" class="d-block">{{ auth()->user()->full_name }}</a>
        </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->

            <li class="nav-item">
                <a href="{{ route('dashboard.home') }}" class="nav-link">
                    <i class="nav-icon fas fa-home"></i>
                    <p>{{ __('site.home')  }}</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('dashboard.categories.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-list"></i>
                    <p>{{ __('site.categories')  }}</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('dashboard.products.index') }}" class="nav-link">
                    <i class="nav-icon fab fa-product-hunt"></i>
                    <p>{{ __('site.products')  }}</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('dashboard.clients.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>{{ __('site.clients')  }}</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('dashboard.orders.index') }}" class="nav-link">
                    <i class="fas fa-cart-plus"></i>
                    <p>{{ __('site.orders')  }}</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('dashboard.users.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-users-cog"></i>
                    <p>{{ __('site.users')  }}</p>
                </a>
            </li>
        </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
    </aside>
