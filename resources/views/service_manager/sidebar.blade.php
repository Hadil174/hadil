 <!-- Sidebar Navigation-->
 <head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  </head>
  
   <div class="d-flex align-items-stretch">     
  <nav id="sidebar">
      <!-- Sidebar Header-->
      {{-- <div class="sidebar-header d-flex align-items-center">
        <div class="avatar"><img src="img/avatar-6.jpg" alt="..." class="img-fluid rounded-circle"></div>
        <div class="title">
         
          
        </div>
      </div> --}}
      <ul class="list-unstyled">
              <li class="active"><a href="index.html"> <i class="icon-home"></i>Home </a></li>
              {{-- <li><a href="tables.html"> <i class="icon-grid"></i>Tables </a></li>
              <li><a href="charts.html"> <i class="fa fa-bar-chart"></i>Charts </a></li>
              <li><a href="forms.html"> <i class="icon-padnote"></i>Forms </a></li> --}}
            
              <li>
                <a href="#roomCleaningDropdown" data-toggle="collapse" aria-expanded="false">
                  <i class="fas fa-broom"></i> Room Cleaning
                </a>
                <ul id="roomCleaningDropdown" class="collapse list-unstyled">
                  <li>
                    <a href="{{ route('service_manager.room_status') }}">Check Room Status</a>
                  </li>
                </ul>
              </li>
            
            
                <li>
                    <a href="#salaryDropdown" data-toggle="collapse" aria-expanded="false">
                      <i class="fas fa-money-bill-wave"></i> Salary Details
                    </a>
                    <ul id="salaryDropdown" class="collapse list-unstyled">
                      <li>
                        <a href="{{ url('salaries') }}">View Salaries</a>
                      </li>
                    </ul>
                  </li>
        <li>
            <a href="#attendanceDropdown" aria-expanded="false" data-toggle="collapse">
                <i class="fas fa-clock"></i> Attendance
              </a>
              <ul id="attendanceDropdown" class="collapse list-unstyled">
                <li>
                  <a href="{{ route('service_manager.attendance.dashboard') }}" style="margin-left: 10px; color: #fff; text-decoration: underline;">
                    View Attendance
                  </a>
                </li>
      
          
            
    </nav>
    <!-- Sidebar Navigation end-->