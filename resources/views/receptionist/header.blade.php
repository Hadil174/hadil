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
        @php
        $notifications = auth()->user()->unreadNotifications;
    @endphp
    
    
    
          
     

      </div>
    </div>
  </nav>
</header>


