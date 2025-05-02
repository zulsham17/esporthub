<nav class="vertnav navbar navbar-light">
    <div class="w-100 mb-4 d-flex">
        <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="{{ route('admin.dashboard') }}">
            SportHub <img src="{{ asset('assets/img/stdc-logo-png.png') }}" class="navbar-brand-img" width="90">
        </a>
    </div>
    <ul class="navbar-nav flex-fill w-100 mb-2">
        <li class="nav-item"><a href="{{ route('admin.dashboard') }}" class="nav-link"><i class="fe fe-home"></i> <span class="ml-3 item-text">Admin Dashboard</span></a></li>
        <li class="nav-item"><a href="{{ route('equipment.index') }}" class="nav-link"><i class="fa fa-box"></i> <span class="ml-3 item-text">Inventori Peralatan Sukan</span></a></li>
        <li class="nav-item"><a href="#" class="nav-link"><i class="fa fa-folder-open"></i> <span class="ml-3 item-text">Senarai Permohonan</span></a></li>
        <li class="nav-item"><a href="#" class="nav-link"><i class="fa fa-users"></i> <span class="ml-3 item-text">Senarai Pengguna</span></a></li>
        <li class="nav-item">
            <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fe fe-log-out"></i> <span class="ml-3 item-text">Log Keluar</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</nav>