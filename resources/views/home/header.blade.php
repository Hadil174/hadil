<!-- Load Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<!-- Compact Header Styles -->
<style>
    .header {
        background-color: rgb(251, 248, 238);
        padding: 6px 0;
        border-bottom: 1px solid #6e5d32;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }

    .logo-img {
        width: 40px;
        height: 40px;
        margin-right: 10px;
        border-radius: 6px;
    }

    .logo-title {
        font-family: 'Montserrat', sans-serif;
        font-weight: 600;
        font-size: 17px;
        color: #6e5d32;
        margin: 0;
        padding: 0;
        text-transform: uppercase;
    }

    .navbar-nav .nav-link {
        color: #6e5d32 !important;
        font-weight: 500;
        margin: 0 10px;
        font-size: 15px;
    }

    .navbar-nav .nav-link:hover {
        color: #3f341c !important;
    }

    .navbar-toggler-icon {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='%236e5d32' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(110, 93, 50, 0.7)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
    }

    .user-actions {
        display: flex;
        gap: 8px;
        margin-left: 10px;
        align-items: center;
    }

    .profile-btn,
    .logout-btn {
        display: flex;
        align-items: center;
        gap: 6px;
        background-color: #a28753;
        color: #fff;
        font-size: 13px;
        padding: 6px 14px;
        border: none;
        border-radius: 20px;
        text-decoration: none;
        transition: background-color 0.2s ease-in-out;
    }

    .profile-btn:hover,
    .logout-btn:hover {
        background-color: #8c6f3d;
    }

    form.logout-form {
        margin: 0;
    }


    @media (max-width: 768px) {
        .navbar-nav {
            background-color: rgb(251, 248, 238);
            padding-top: 10px;
            border-top: 1px solid #6e5d32;
        }

        .logo-title {
            font-size: 15px;
        }

        .navbar-nav .nav-link {
            font-size: 14px;
        }
    }
</style>

<!-- Compact Header HTML -->
<div class="header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-3 logo_section">
                <div class="logo d-flex align-items-center">
                    <a href="{{ url('/') }}" class="d-flex align-items-center">
                        <img src="{{ asset('images/Black and Gold Vintage Luxury Hotel Logo.png') }}" alt="Logo" class="logo-img">
                        <h1 class="logo-title">ELLISSIR</h1>
                    </a>
                </div>
            </div>

            <div class="col-md-9">
                <nav class="navigation navbar navbar-expand-md navbar-light">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04"
                        aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarsExample04">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="{{ url('/') }}">Home</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="{{ url('/about') }}">About</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ url('/room') }}">Our Room</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ url('/gallery') }}">Gallery</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ url('/blog') }}">Blog</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ url('/contact') }}">Contact</a></li>

                            @auth
                            <div class="user-actions">
                                <a href="{{ url('request_service') }}" class="profile-btn">
                                    <i class="fas fa-concierge-bell"></i> Services
                                </a>
                                
                                
                                <a href="{{ route('profile.show') }}" class="profile-btn">
                                    <i class="fas fa-user"></i> Profile
                                </a>
                                <form method="POST" action="{{ route('logout') }}" class="logout-form">
                                    @csrf
                                    <button type="submit" class="logout-btn">
                                        <i class="fas fa-sign-out-alt"></i> Logout
                                    </button>
                                </form>
                            </div>
                            @else
                                @if (Route::has('login'))
                                <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                                @endif
                                @if (Route::has('register'))
                                <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Sign Up</a></li>
                                @endif
                            @endauth
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>
