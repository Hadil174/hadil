<header class="header">
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid d-flex align-items-center justify-content-between">
      <div class="navbar-header">
        <!-- Navbar Header -->
        <a class="navbar-brand">
          <div class="brand-text brand-big visible text-uppercase"><strong class="text-primary"></strong><strong>Receptionist</strong></div>
          <div class="brand-text brand-sm"><strong class="text-primary">D</strong><strong>A</strong></div>
        </a>
        <!-- Sidebar Toggle Btn-->
        <button class="sidebar-toggle"><i class="fa fa-long-arrow-left"></i></button>
      </div>
      <div class="right-menu list-inline no-margin-bottom">
        <!-- Profile Link -->
        <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
          {{ __('Profile') }}
        </x-responsive-nav-link>

        <!-- Log out -->
        <div class="list-inline-item logout">
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
          <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout <i class="icon-logout"></i>
          </a>
        </div>
        
        @if(session('success'))
          <div class="alert alert-success" style="padding: 5px 10px; margin: 0 10px; display: inline-block;">
            {{ session('success') }}
          </div>
        @endif
        @if(session('error'))
          <div class="alert alert-danger" style="padding: 5px 10px; margin: 0 10px; display: inline-block;">
            {{ session('error') }}
          </div>
        @endif

        <div class="attendance-buttons" style="display: inline-flex; gap: 10px; margin-left: 15px;">
          <form action="{{ route('receptionist.attendance.checkin') }}" method="POST">
              @csrf
              <button type="submit" class="btn-checkin" style="background-color: #584e4f94; color: white; border: none; padding: 8px 15px; border-radius: 4px; cursor: pointer; font-weight: 500; transition: background-color 0.3s;">
                  <i class="fas fa-sign-in-alt" style="margin-right: 5px;"></i> Check In
              </button>
          </form>

          <form action="{{ route('receptionist.attendance.checkout') }}" method="POST">
              @csrf
              <button type="submit" class="btn-checkout" style="background-color: #584e4f94; color: white; border: none; padding: 8px 15px; border-radius: 4px; cursor: pointer; font-weight: 500; transition: background-color 0.3s;">
                  <i class="fas fa-sign-out-alt" style="margin-right: 5px;"></i> Check Out
              </button>
          </form>
        </div>

        @php
          $notifications = auth()->user()->unreadNotifications;
        @endphp
      </div>
    </div>
  </nav>
</header>

<style>
  .btn-checkin:hover {
    background-color: #b0b3b1 !important;
  }
  
  .btn-checkout:hover {
    background-color: #9e9d9d !important;
  }
  
  .alert-success {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
  }
  
  .alert-danger {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
  }
</style>