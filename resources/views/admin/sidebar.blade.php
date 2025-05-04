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
            <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse">    <i class="fas fa-hotel icon"></i> Hotels Room</i> </a>
              <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
               <li><a href="{{ url('create_room') }}">add Room</a></li> 
                <li><a href="{{ url('view_room') }}">view room</a></li>
                <li><a href="#">Page</a></li>
              </ul>
            </li>
            <li>
              <a href="#hrDropdown" aria-expanded="false" data-toggle="collapse">
                <i class="fa fa-users"></i> Human Resources
              </a>
              <ul id="hrDropdown" class="collapse list-unstyled">
                 
                  <li><a href="{{ url('view_employee') }}">Employees</a></li>
                  <li><a href="{{ url('add_salary') }}">Add salary</a></li>
                  <li><a href="{{ url('salaries') }}">Salary Details</a></li>
                  <!-- Add other HR related links here -->
              </ul>
          </li>
          <li>
            <a href="#reservationDropdown" aria-expanded="false" data-toggle="collapse">
              <i class="fas fa-calendar-check"></i> Reservation Lists
            </a>
            <ul id="reservationDropdown" class="collapse list-unstyled">
                <li><a href="{{ url('view_reservations') }}">View Reservations</a></li>
                <li><a href="{{ url('reservation_history') }}">Reservation History</a></li>
            </ul>
        </li>
        <li>
          <a href="#messageDropdown" aria-expanded="false" data-toggle="collapse">
              <i class="fas fa-envelope"></i> Messages
          </a>
          <ul id="messageDropdown" class="collapse list-unstyled">
              <li><a href="{{ url('all_messages') }}">all Messages</a></li>
              <li><a href="{{ url('unread_contacts') }}">Unread Messages</a></li>
          </ul>
      </li>
      
           
        
          
  </nav>
  <!-- Sidebar Navigation end-->