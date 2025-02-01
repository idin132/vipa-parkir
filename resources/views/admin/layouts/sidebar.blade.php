<!-- CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
<link rel="stylesheet" href="../assets/css/sidebar.css">



<body id="body-pd">
    <header class="header" id="header">
        <div class="header_toggle">
            <i class='bx bx-menu' id="header-toggle"></i>
        </div>
    </header>
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div>
                <a href="#" class="nav_logo">
                    <i class='bx bx-layer nav_logo-icon'></i>
                    <span class="nav_logo-name">VIPA</span>
                </a>
                <div class="nav_list">
                    <a href="{{ route('dashboard.index')}}" class="nav_link active">
                        <i class='bx bx-grid-alt nav_icon'></i>
                        <span class="nav_name">Dashboard</span>
                    </a>
                    <a href="{{ route('anggota.index')}}" class="nav_link">
                        <i class='bx bx-user nav_icon'></i>
                        <span class="nav_name">Anggota</span>
                    </a>
                    <a href="{{ route('pengunjung.index')}}" class="nav_link">
                        <i class='bx bx-group nav_icon'></i>
                        <span class="nav_name">Data Pengunjung</span>
                    </a>
                </div>
            </div>
            <a href="{{ route('logout')}}" class="nav_link" onclick="event.preventDefault();
                 document.getElementById('logout-form').submit();">
                <i class='bx bx-log-out nav_icon'></i>
                <span class="nav_name">SignOut</span>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </a>
        </nav>
    </div>

    <!--Container Main start-->
    <main>
        <div class="container mt-4">
            @yield('content')
        </div>
    </main>
    <!--Container Main end-->

    <!-- JS -->
    <script src="../assets/js/sidebar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>