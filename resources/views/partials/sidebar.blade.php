<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard">
        <div class="sidebar-brand-icon">
            <img src="https://i.postimg.cc/LsZX3FWV/BIARPRO32.png" alt="" width="30px">
        </div>
        <div class="sidebar-brand-text mx-3 mt-2">BiarPro @if(Auth::user()->hasRole(['contributor-pro']))<i class="fa fa-fas fa-star text-warning" ></i>@endif</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="/dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    @if(Auth::user()->hasRole(['super-admin'])||(Auth::user()->member!=1 && Auth::user()->hasRole(['contributor-pro'])))
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
        Manajemen User
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ Request::is('dashboard/role*') || Request::is('dashboard/user*') ? 'active' : '' }}">
        <a class="nav-link " href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-users"></i>
            <span>User</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">User:</h6>
                @if(Auth::user()->hasRole(['super-admin']))
                <a class="collapse-item" href="{{ route('role.index') }}">Role</a>
                @endif
                <a class="collapse-item" href="{{ route('user.index') }}">User</a>
            </div>
        </div>
    </li>
    @endif

    <!-- Divider -->
    @if(Auth::user()->hasRole(['super-admin','admin']))
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
       Data Referensi
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ Request::is('dashboard/kategoribisnis*') || Request::is('dashboard/ref_kata_pembuka*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree"
            aria-expanded="true" aria-controls="collapseThree">
            <i class="fas fa-fw fa-book"></i>
            <span>Referensi</span>
        </a>
        <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Kategori Bisnis:</h6>
                <a class="collapse-item" href="{{ route ('kategoribisnis.index') }}">Kategori</a>
                <h6 class="collapse-header">Referensi Artikel:</h6>
                <a class="collapse-item" href="{{ route ('ref_kata_pembuka.index') }}">Kata Pembuka</a>
                <h6 class="collapse-header">Referensi Paket:</h6>
                <a class="collapse-item" href="{{ route('paket.index') }}">Paket</a>
            </div>
        </div>
    </li>
    @endif
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
       Payment
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ Request::is('dashboard/pembayaran') || Request::is('dashboard/komisi') ? 'active' : ''}}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFor"
            aria-expanded="true" aria-controls="collapseFor">
            <i class="fas fa-fw fa-dollar-sign"></i>
            <span>Payment</span>
        </a>
        <div id="collapseFor" class="collapse" aria-labelledby="headingFor" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Pembayaran:</h6>
                @if(Auth::user()->hasRole(['super-admin','admin']))
                <a class="collapse-item" href="{{ route ('pembayaran.index') }}">Pembayaran</a>
                @endif
                <a class="collapse-item" href="{{ route ('komisi.index') }}">Komisi</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">


    <!-- Heading -->
    <div class="sidebar-heading">
        Biar PRO
    </div>

    <!-- Nav Item - Charts -->
    <li class="nav-item {{ Request::is('dashboard/artikel') ? 'active' : '' }}">
        <a class="nav-link active" href="{{ route('artikel.index') }}">
            <i class="fas fa-fw fa-newspaper"></i>
            <span>Artikel</span>
        </a>
    </li>    
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
    

</ul>
<!-- End of Sidebar -->
