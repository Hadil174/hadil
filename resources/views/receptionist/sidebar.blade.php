<!-- Sidebar Navigation -->
<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  
    <style>
      #sidebar {
          background: linear-gradient(135deg, #2c3e50 0%, #1a252f 100%);
          min-width: 250px;
          color: #fff;
          height: 100vh;
          position: sticky;
          top: 0;
          transition: all 0.3s;
          box-shadow: 2px 0 10px rgba(0,0,0,0.1);
      }
      
      #sidebar ul.components {
          padding: 20px 0;
      }
      
      #sidebar ul li a {
          padding: 12px 25px;
          display: flex;
          align-items: center;
          color: #ecf0f1;
          font-weight: 500;
          text-decoration: none;
          transition: all 0.3s;
          border-left: 3px solid transparent;
      }
      
      #sidebar ul li a i {
          margin-right: 12px;
          width: 20px;
          text-align: center;
          font-size: 1.1rem;
      }
      
      #sidebar ul li a:hover {
          background: rgba(255,255,255,0.05);
          color: #fff;
          border-left: 3px solid #3498db;
      }
      
      #sidebar ul li.active > a {
          background: rgba(52, 152, 219, 0.1);
          color: #3498db;
          border-left: 3px solid #3498db;
      }
      
      .sidebar-section-title {
          padding: 15px 25px 5px;
          font-size: 0.75rem;
          text-transform: uppercase;
          letter-spacing: 1px;
          color: #95a5a6;
          margin-top: 10px;
          font-weight: 600;
      }
      
      #sidebar .collapse {
          background: rgba(0,0,0,0.1);
      }
      
      #sidebar .collapse a {
          padding-left: 50px;
          font-size: 0.9rem;
      }
      
      #sidebar .collapse a:hover {
          background: rgba(255,255,255,0.03);
      }
      
      .sidebar-brand {
          padding: 20px 25px;
          display: flex;
          align-items: center;
          font-size: 1.2rem;
          font-weight: 600;
          color: #fff;
          border-bottom: 1px solid rgba(255,255,255,0.1);
      }
      
      .sidebar-brand i {
          margin-right: 10px;
          color: #3498db;
      }
      
      @media (max-width: 768px) {
          #sidebar {
              min-width: 80px;
              max-width: 80px;
              text-align: center;
          }
          
          .sidebar-brand span,
          #sidebar ul li a span,
          .sidebar-section-title {
              display: none;
          }
          
          #sidebar ul li a {
              justify-content: center;
              padding: 15px 10px;
          }
          
          #sidebar ul li a i {
              margin-right: 0;
              font-size: 1.3rem;
          }
          
          #sidebar .collapse a {
              padding: 10px;
              text-align: center;
          }
      }
    </style>
  </head>
  
  <div class="d-flex align-items-stretch">     
  <nav id="sidebar">
      <div class="sidebar-brand">
          <i class="fas fa-hotel"></i>
          <span>Hotel Reception</span>
      </div>
      
      <ul class="list-unstyled components">
          <li class="sidebar-section-title">Hotel Management</li>
          <li>
            <a href="#roomDropdown" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
              <i class="fas fa-bed"></i>
              <span>Hotel Rooms</span>
            </a>
            <ul class="collapse list-unstyled" id="roomDropdown">
              <li><a href="{{ url('list_room') }}">Rooms</a></li>
            </ul>
          </li>
          
  
          <li class="sidebar-section-title">Reservations</li>
          <li>
              <a href="#bookingDropdown" data-toggle="collapse" aria-expanded="false">
                  <i class="fas fa-calendar-check"></i>
                  <span>Bookings</span>
              </a>
              <ul class="collapse list-unstyled" id="bookingDropdown">
                  <li><a href="{{ url('list_booking') }}">All Bookings</a></li>
                  <li><a href="{{ url('today_checkins') }}">Today's Check-ins</a></li>
                  <li><a href="{{ url('today_checkouts') }}">Today's Check-outs</a></li>
              </ul>
          </li>
  
          <li class="sidebar-section-title">Guest Services</li>
          <li>
              <a href="{{ url('guest_list') }}">
                  <i class="fas fa-users"></i>
                  <span>Guest Management</span>
              </a>
          </li>
          <li>
              <a href="{{ url('room_service') }}">
                  <i class="fas fa-concierge-bell"></i>
                  <span>Room Service</span>
              </a>
          </li>
  
          <li class="sidebar-section-title">Reports</li>
          <li>
              <a href="{{ url('occupancy_report') }}">
                  <i class="fas fa-chart-line"></i>
                  <span>Occupancy Report</span>
              </a>
          </li>
          <!-- resources/views/layouts/receptionist-notifications.blade.php -->

      </ul>

  </nav>