


<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')
    <style type="text/css">
        body {
            background-color: #121212;
            font-family: 'Segoe UI', sans-serif;
            color: #e0e0e0;
            margin: 0;
            padding: 0;
        }
    
        label {
            display: inline-block;
            width: 200px;
            margin-bottom: 10px;
        }
    
        .div_deg {
            padding: 10px 0;
        }
    
        .form-container {
            background-color: #1e1e1e;
            padding: 30px;
            border-radius: 10px;
            max-width: 600px;
            margin: 40px auto; /* center horizontally */
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);
        }
    
        input[type="text"],
        input[type="email"],
        input[type="date"],
        textarea,
        select,
        input[type="file"] {
            width: calc(100% - 210px); /* keep alignment with label */
            padding: 8px;
            border-radius: 6px;
            border: 1px solid #444;
            background-color: #2a2a2a;
            color: #f5f5f5;
            font-size: 14px;
        }
    
        textarea {
            resize: vertical;
        }
    
        button[type="submit"] {
            margin-top: 20px;
            background-color: #27ae60;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 14px;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
    
        button[type="submit"]:hover {
            background-color: #219150;
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




