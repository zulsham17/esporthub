<nav class="vertnav navbar navbar-light">
    <div class="w-100 mb-4 d-flex">
        <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="{{ route('user.dashboard') }}">
            SportHub <img src="{{ asset('assets/img/stdc-logo-png.png') }}" class="navbar-brand-img" width="90">
        </a>
    </div>
    <ul class="navbar-nav flex-fill w-100 mb-2">
        <li class="nav-item"><a href="{{ route('user.dashboard') }}" class="nav-link"><i class="fe fe-home"></i> <span class="ml-3 item-text">Dashboard</span></a></li>
        <li class="nav-item"><a href="#" class="nav-link"><i class="fa fa-check-to-slot"></i> <span class="ml-3 item-text">My Permohonan</span></a></li>
        <li class="nav-item"><a href="#" class="nav-link"><i class="fa-solid fa-envelope-open-text"></i> <span class="ml-3 item-text">Senarai Pinjaman</span></a></li>
        <li class="nav-item"><a href="#" class="nav-link"><i class="fa-solid fa-table-tennis-paddle-ball"></i> <span class="ml-3 item-text">Senarai Peralatan</span></a></li>
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