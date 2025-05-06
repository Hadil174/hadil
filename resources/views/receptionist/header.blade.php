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
    
    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fa fa-bell"></i>
            @if($notifications->count())
                <span class="badge badge-danger">{{ $notifications->count() }}</span>
            @endif
        </a>
        <div class="dropdown-menu dropdown-menu-right">
            @forelse($notifications as $notification)
                <a href="#" class="dropdown-item">
                    {{ $notification->data['message'] }} - {{ $notification->data['service_name'] }} (${{ $notification->data['price'] }})
                </a>
            @empty
                <span class="dropdown-item">No new notifications</span>
            @endforelse
        </div>
    </li>
    
          
     

      </div>
    </div>
  </nav>
</header>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const bell = document.querySelector('.notification-bell');
    const dropdown = document.querySelector('.notification-dropdown-content');

    if (bell && dropdown) {
      bell.addEventListener('click', function (e) {
        e.stopPropagation();
        dropdown.classList.toggle('show');
      });

      window.addEventListener('click', function () {
        dropdown.classList.remove('show');
      });
    }
  });
</script>
<style>
  .notification-dropdown {
  position: relative;
  display: inline-block;
  margin-left: 20px;
}

.notification-bell {
  background: none;
  border: none;
  position: relative;
  font-size: 1.2rem;
}

.notification-dropdown-content {
  display: none;
  position: absolute;
  right: 0;
  top: 30px;
  background-color: white;
  min-width: 300px;
  box-shadow: 0 4px 8px rgba(0,0,0,0.1);
  z-index: 1000;
  max-height: 400px;
  overflow-y: auto;
  border-radius: 4px;
  padding: 10px;
}

.notification-dropdown-content.show {
  display: block;
}

.notification-item {
  padding: 10px;
  border-bottom: 1px solid #eee;
}

.notification-message {
  margin: 0;
  font-weight: 500;
}

.notification-service {
  margin-top: 4px;
  font-size: 0.85rem;
  color: #555;
}

.badge.badge-danger {
  position: absolute;
  top: -5px;
  right: -5px;
  background: red;
  color: white;
  font-size: 0.7rem;
  padding: 3px 6px;
  border-radius: 50%;
}

</style>
