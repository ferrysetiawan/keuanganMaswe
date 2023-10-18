<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('dashboard') }}">KEUANGAN MASWE</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('dashboard') }}">KM</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard') }}"><i class="fas fa-fire"></i>
                    <span>Dashboard</span></a>
            </li>
            @can('manage_masterData')
            <li class="dropdown {{ request()->is('dashboard/master-data*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-th-list"></i><span>Master Data</span></a>
                <ul class="dropdown-menu">
                    @can('kolam')
                        <li class="{{ request()->is('dashboard/master-data/kolam*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('kolam') }}">Kolam</a></li>
                    @endcan
                    @can('kategoriIn')
                        <li class="{{ request()->is('dashboard/master-data/kategori-in*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('kategori-in') }}">Kategori In</a></li>
                    @endcan
                    @can('kategoriOut')
                        <li class="{{ request()->is('dashboard/master-data/kategori-out*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('kategori-out') }}">Kategori Out</a></li>
                    @endcan
                </ul>
            </li>
            @endcan
            @if (Gate::check('manage_penjualan') || Gate::check('manage_pembelian'))
                <li class="menu-header">KELOLA KEUANGAN</li>
                @can('manage_penjualan')
                <li class="nav-item {{ request()->is('dashboard/penjualan*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('penjualan') }}"><i class="fas fa-arrow-up"></i>
                        <span>Penjualan</span></a>
                </li>
                @endcan
                @can('manage_pembelian')
                <li class="nav-item {{ request()->is('dashboard/pembelian*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('pembelian') }}"><i class="fas fa-arrow-down"></i>
                        <span>Pembelian</span></a>
                </li>
                @endcan
            @endif
            @can('manage_laporan')
                <li class="menu-header">LAPORAN KEUANGAN</li>
                <li class="nav-item {{ request()->is('dashboard/laporan*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('laporan') }}"><i class="fas fa-file"></i>
                        <span>Laporan</span></a>
                </li>
            @endcan
            @if (Gate::check('manage_role') || Gate::check('manage_user'))
                <li class="menu-header">PENGATURAN</li>
                @can('manage_role')
                <li class="nav-item {{ request()->is('dashboard/role*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('role') }}"><i class="fas fa-lock"></i>
                        <span>Role</span></a>
                </li>
                @endcan
                @can('manage_user')
                <li class="nav-item {{ request()->is('dashboard/user*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('user') }}"><i class="fas fa-user"></i>
                        <span>User</span></a>
                </li>
                @endcan
            @endif
        </ul>

        {{-- <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-rocket"></i> Documentation
            </a>
        </div> --}}
    </aside>
</div>
