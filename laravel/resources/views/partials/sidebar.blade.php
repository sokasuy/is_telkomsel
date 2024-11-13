@php
    use App\Models\Permission;
@endphp
<!-- Add icons to the links using the .nav-icon class
                        with font-awesome or any other icon font library -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard.home') }}" class="brand-link">
        <img src="{{ asset('assets/dist/img/TelkomselLOGO.png') }}" alt="Telkomsel Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">TELKOMSEL</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('assets/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <!-- UPDATE JHONATAN -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard.home') }}" class="nav-link {{ Request::is('/') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

            @if (Permission::where('role', Auth::user()->role)->where('menu_group', 'sales')->where('read', true)->exists())
                <li class="nav-item {{ Request::is('sales*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Request::is('sales*') ? 'active' : '' }}">
                        <i class="nav-icon fab fa-salesforce"></i>
                        <p>
                            Sales
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if (Permission::where('role', Auth::user()->role)->where('view', 'spb')->where('read', true)->exists())
                            <li class="nav-item">
                                <a href="{{ route('sales.spb') }}"
                                    class="nav-link {{ Request::is('sales/spb*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>SPB</p>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

                {{-- @if (Permission::where('role', Auth::user()->role)->where('grup_menu', 'master')->where('read', 1)->exists())
<li class="nav-item {{ Request::is('master*') ? 'menu-open' : '' }}">
    <a href="#" class="nav-link {{ Request::is('master*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-database"></i>
        <p>
            Master
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        @if (Permission::where('role', Auth::user()->role)->where('view', 'msbarang')->where('read', 1)->exists())
            <li class="nav-item">
                <a href="{{ route('msbarang.index') }}"
                    class="nav-link {{ Request::is('master/msbarang*') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Data Master Barang</p>
                </a>
            </li>
        @endif
        @if (Permission::where('role', Auth::user()->role)->where('view', 'mspromo')->where('read', 1)->exists())
            <li class="nav-item">
                <a href="{{ route('mspromo.masterpromo') }}"
                    class="nav-link {{ Request::is('master/mspromo*') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Medbox Promotion</p>
                </a>
            </li>
        @endif
    </ul>
</li>
@endif --}}

                <!-- REPORT PENJUALAN -->
                {{-- @if (Permission::where('role', Auth::user()->role)->where('grup_menu', 'reports')->where('read', 1)->exists())
    <li class="nav-item {{ Request::is('reports*') ? 'menu-open' : '' }}">
        <a href="#" class="nav-link {{ Request::is('reports*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-table"></i>
            <p>
                Reports
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            @if (Permission::where('role', Auth::user()->role)->where('view', 'hutang')->where('read', 1)->exists())
                <li class="nav-item">
                    <a href="{{ route('reports.hutang') }}"
                        class="nav-link {{ Request::is('reports/hutang*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Data Hutang</p>
                    </a>
                </li>
            @endif

        </ul>
        <ul class="nav nav-treeview">
            @if (Permission::where('role', Auth::user()->role)->where('view', 'outstanding-hutang')->where('read', 1)->exists())
                <li class="nav-item">
                    <a href="{{ route('reports.outstanding-hutang') }}"
                        class="nav-link {{ Request::is('reports/outstanding-hutang*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Outstanding Hutang</p>
                    </a>
                </li>
            @endif

        </ul>
        <ul class="nav nav-treeview">
            @if (Permission::where('role', Auth::user()->role)->where('view', 'expiry-date')->where('read', 1)->exists())
                <li class="nav-item">
                    <a href="{{ route('reports.expirydate') }}"
                        class="nav-link {{ Request::is('reports/expiry-date*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Data Expiry Date</p>
                    </a>
                </li>
            @endif

        </ul>
        <ul class="nav nav-treeview">
            @if (Permission::where('role', Auth::user()->role)->where('view', 'penjualan')->where('read', 1)->exists())
                <li class="nav-item">
                    <a href="{{ route('reports.penjualan') }}"
                        class="nav-link {{ Request::is('reports/penjualan*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Data Penjualan</p>
                    </a>
                </li>
            @endif

        </ul>
        <ul class="nav nav-treeview">
            @if (Permission::where('role', Auth::user()->role)->where('view', 'periode-penjualan')->where('read', 1)->exists())
                <li class="nav-item">
                    <a href="{{ route('reports.summarypenjualan') }}"
                        class="nav-link {{ Request::is('reports/summary-penjualan*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Data Summary Penjualan</p>
                    </a>
                </li>
            @endif
        </ul>
        <ul class="nav nav-treeview">
            @if (Permission::where('role', Auth::user()->role)->where('view', 'rekap-barang-terjual')->where('read', 1)->exists())
                <li class="nav-item">
                    <a href="{{ route('reports.rekap-barang-terjual') }}"
                        class="nav-link {{ Request::is('reports/rekap-barang-terjual*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Rekap Barang Terjual</p>
                    </a>
                </li>
            @endif

        </ul>
    </li>
    <!-- REPORT PENJUALAN -->
@endif --}}

                @if (Permission::where('role', Auth::user()->role)->where('menu_group', 'authentication')->where('read', true)->exists())
                    <li
                        class="nav-item {{ Request::is('authentication*') || Request::is('roles*') || Request::is('permission*') ? 'menu-open' : '' }}">
                        <a href="#"
                            class="nav-link {{ Request::is('authentication*') || Request::is('roles*') || Request::is('permission*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Authentication
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if (Permission::where('role', Auth::user()->role)->where('view', 'users')->where('read', true)->exists())
                                <li class="nav-item">
                                    <a href="{{ route('auth.users') }}"
                                        class="nav-link {{ Request::is('authentication/users*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Users</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                        <ul class="nav nav-treeview">
                            @if (Permission::where('role', Auth::user()->role)->where('view', 'roles')->where('read', true)->exists())
                                <li class="nav-item">
                                    <a href="{{ route('auth.roles') }}"
                                        class="nav-link {{ Request::is('authentication/roles*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Roles</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                        <ul class="nav nav-treeview">
                            @if (Permission::where('role', Auth::user()->role)->where('view', 'permission')->where('read', true)->exists())
                                <li class="nav-item">
                                    <a href="{{ route('auth.permission') }}"
                                        class="nav-link {{ Request::is('authentication/permissions*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Permission</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                        {{-- <ul class="nav nav-treeview">
            @if (Permission::where('role', Auth::user()->role)->where('view', 'customers')->where('read', true)->exists())
                <li class="nav-item">
                    <a href="{{ route('auth.customers') }}"
                        class="nav-link {{ Request::is('authentication/customers*') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Customers</p>
                    </a>
                </li>
            @endif
        </ul> --}}
                    </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
