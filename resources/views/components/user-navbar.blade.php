<header id="header" class="header d-flex align-items-center light-background sticky-top">
    <div class="container-fluid position-relative d-flex align-items-center justify-content-between">

        <a href="index.html" class="logo d-flex align-items-center me-auto me-xl-0">
            <h1 class="sitename">Beauty Salon</h1>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="{{route('user.home')}}" class="">Home</a></li>
                <li><a href="{{ route('user.services.index') }}" class="">Services</a></li>
                <li><a href="{{ route('user.stylists.index') }}" class="">Employee</a></li>
                <li><a href="{{ route('user.appointment.index') }}" class="">Appointment</a></li>
                <li><a href="{{ route('user.suggestions.index') }}" class="">Suggestions</a></li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        <div class="header-social-links d-flex align-items-center">
            <div class="dropdown">
                <a href="#" class="dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown">
                    <span>{{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a href="#" onclick="confirmLogout()">Logout</a></li>
                </ul>
            </div>
        </div>

    </div>
</header>

<!-- Logout Script -->
<script>
    function confirmLogout() {
        if (confirm('Are you sure you want to log out?')) {
            document.getElementById('logout-form').submit();
        }
    }
</script>

<!-- Logout Form (Hidden) -->
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
