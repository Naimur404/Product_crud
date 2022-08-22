<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="index.html">Admin Panel</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html"></a>
    </div>

    <ul class="sidebar-menu">

        <li class="@yield('dashbaord')"><a class="nav-link" href="{{ route('dashboard') }}"><i class="fas fa-hand-point-right"></i> <span>Dashboard</span></a></li>

        <li class="nav-item dropdown @yield('product')">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-hand-point-right"></i><span>Product</span></a>
            <ul class="dropdown-menu">
                <li class="@yield('manage_product')"><a class="nav-link" href="{{ route('product.show') }}"><i class="fas fa-angle-right"></i> Manage Product</a></li>
                <li class="@yield('add_product')"><a class="nav-link" href="{{ url('/product/create') }}"><i class="fas fa-angle-right"></i> Add Product</a></li>
            </ul>
        </li>


    </ul>
</aside>
