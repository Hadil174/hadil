


<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')
    <style type="text/css">
        label{
            display: inline-block;
            width: 200px;
        }
        .div_deg{
            padding-top: 30px;
        }
        .div_centre{
            text-align: center;
            padding-top: 40px;
        }
       
        </style>
  </head> 
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> Admin </title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="all,follow
  
  
  <body>
    @include('admin.header')
    @include('admin.sidebar')
    <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">
            <form action="{{ url('/add_employee') }}" method="POST" enctype="multipart/form-data">

                @csrf  <!-- Add CSRF token for security -->
                <div class="div_deg">
                <label for="first_name">First Name:</label>
                <input type="text" id="first_name" name="first_name" required>
            </div>
           
                <div class="div_deg">
                <label for="last_name">Last Name:</label>
                <input type="text" id="last_name" name="last_name" required>
            </div>
                <div class="div_deg">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
                <div class="div_deg">
                <label for="phone">Phone:</label>
                <input type="text" id="phone" name="phone">
            </div>
                <div class="div_deg">
                <label for="address">Address:</label>
                <textarea id="address" name="address" rows="3"></textarea>
            </div>
                <div class="div_deg">
                <label for="role">Role:</label>
                <select id="role" name="role" required>
                    <option value="Receptionist">Receptionist</option>
                    <option value="Manager">Manager</option>
                    <option value="Housekeeping">Housekeeping</option>
                    <option value="Maintenance">Maintenance</option>
                </select>
            </div>
                <div class="div_deg">
                <label for="department">Department:</label>
                <input type="text" id="department" name="department" required>
                <div class="div_deg">
                <label for="hire_date">Hire Date:</label>
                <input type="date" id="hire_date" name="hire_date" required>
            </div>
                
                <div class="div_deg">
                <label for="employment_status">Employment Status:</label>
                <select id="employment_status" name="employment_status" required>
                    <option value="Active">Active</option>
                    <option value="On Leave">On Leave</option>
                    <option value="Terminated">Terminated</option>
                </select>
            </div>
                <div class="div_deg"> 
                <label for="profile_picture">Profile Picture:</label>
                <input type="file" id="profile_picture" name="profile_picture" accept="image/*">
            </div>
                <button type="submit">Add Employee</button>
            </div>
            </form>
          </div>
        </div>
    </div>
   
    @include('admin.footer')
  </body>
</html>




