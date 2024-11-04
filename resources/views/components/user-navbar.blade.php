<nav class="navbar navbar-expand-lg bg-transparent border-bottom border-body" data-bs-theme="light">
        <div class="container-fluid">
            <div class="navbar-brand text-dark mb-0 h1 font-md poppins-extrabold-italic">Sisir Emosi</div>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item">
                            <a href="{{ route('user.home') }}" class="nav-link text-dark poppins-semibold">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('user.service') }}" class="nav-link text-dark poppins-semibold">Services</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('user.stylist') }}" class="nav-link text-dark poppins-semibold">Stylists</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('user.appointment') }}" class="nav-link text-dark poppins-semibold">Appointment</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('user.suggestion') }}" class="nav-link text-dark poppins-semibold">Suggestions</a>
                        </li>
                    </ul>
                </div>

        </div>
        <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-dark poppins-reguler" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                    <ul class="dropdown-menu">
                        <li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: flex;" onsubmit="return confirm('Are you sure to Log out?')">
                                @csrf
                            </form>
                            <a class="p-2 text-decoration-none" href="{{ route('logout') }}" onclick="event.preventDefault(); confirmLogout();">
                                Logout
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <script>
        function confirmLogout() {
            if (confirm('Are you sure you want to log out?')) {
                document.getElementById('logout-form').submit();
            }
        }
    </script>