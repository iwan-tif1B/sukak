<nav class="navbar bg-light navbar-light">
    <a href="index.html" class="navbar-brand mx-4 mb-3">
        <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>DASHMIN</h3>
    </a>
    <div class="d-flex align-items-center ms-4 mb-4">
        <div class="position-relative">
            <img class="rounded-circle" src="{{ asset('assets') }}/img/user.jpg" alt="" style="width: 40px; height: 40px;">
            <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
        </div>
        <div class="ms-3">
            <h6 class="mb-0">{{Session::get('name')}}</h6>
            @if (Session::get('user_role') == 1)
                <span>Admin</span>
            @else
                <span>Petugas</span>
            @endif
            
        </div>
    </div>
    <div class="navbar-nav w-100">
        <a href="{{ route('home') }}" class="nav-item nav-link {{ $title === "Dashboard" ? 'active' : '' }}"><i class="fa-solid fa-hospital"></i>Dashboard</a>

        <a href="{{ route('m-pasien.index') }}" class="nav-item nav-link {{ $title === "Pendaftaran Pasien" ? 'active' : '' }}"><i class="fa-solid fa-hospital-user me-2"></i>Pendaftaran Pasien</a>

        <a href="{{ route('trx-registrasi.index') }}" class="nav-item nav-link {{ $title === "Manajemen Registrasi" ? 'active' : '' }}"><i class="fa-solid fa-stethoscope"></i>Manajemen Registrasi</a>

        <a href="{{ route('m-layanan.index') }}" class="nav-item nav-link {{ $title === "Manajemen Layanan" ? 'active' : '' }}"><i class="fa fa-chart-bar me-2"></i>Manajemen Layanan</a>
        
        @if(Session::get('user_role') == 1)
        <a href="{{ route('m-petugas.index') }}" class="nav-item nav-link {{ $title === "Manajemen Petugas" ? 'active' : '' }}"><i class="fa fa-user me-2"></i>Manajemen Petugas</a>
        @endif
    </div>
</nav>