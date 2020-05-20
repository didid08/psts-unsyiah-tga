<div class="sidebar-main sidebar-menu-one sidebar-expand-md sidebar-color">
    <div class="mobile-sidebar-header d-md-none">
        <div class="header-logo">
            <a href="#"><img src="img/logo1.png" alt="logo"></a>
        </div>
    </div>
    <div class="sidebar-menu-content">
        <ul class="nav nav-sidebar-menu sidebar-toggle-view">
            
            @if ($category == 'tamu')
                <li class="nav-item">
                    <a href="{{ route('main.tamu.informasi-tga') }}" class="nav-link{{ $nav_item_active === 'informasi-tga' ? ' menu-active' : '' }}"><i class="fas fa-info-circle"></i><span>Informasi TGA</span></a>
                </li>
            @else
                <li class="nav-item">
                    <a href="{{ route('main.dashboard', ['category' => $category]) }}" class="nav-link{{ $nav_item_active === 'dashboard' ? ' menu-active' : '' }}"><i class="flaticon-dashboard"></i><span>Dashboard</span></a>
                </li>
            @endif
            <li class="nav-item">
                <a href="{{ route('main.info-dosen', ['category' => $category]) }}" class="nav-link{{ $nav_item_active === 'info-dosen' ? ' menu-active' : '' }}"><i class="fas fa-users"></i><span>Info Dosen</span></a>
            </li>
            <li class="nav-item">
                <a href="{{ route('main.rekap-dosen', ['category' => $category]) }}" class="nav-link{{ $nav_item_active === 'rekap-dosen' ? ' menu-active' : '' }}"><i class="fas fa-table"></i><span>Rekap Dosen</span></a>
            </li>
        </ul>
    </div>
</div>