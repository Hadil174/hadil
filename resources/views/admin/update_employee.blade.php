




<!DOCTYPE html>
<html>
  <head> 
    <base href="/public">
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

  
  <body>
        
    @include('admin.header')
    @include('admin.sidebar')

   
        <div class="page-content">
            <div class="page-header">
              <div class="container-fluid">
                <form action="{{ route('edit_employee', $data->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf  <!-- ✅ Add this line to include CSRF token -->
                    @if(session('success'))
               <div class="alert alert-success">
                     {{ session('success') }}
                </div>
                    @endif
                    <div class="div_centre">
                        <h1 style="font-size: 30px ;font-wight:bold;">Update Employee </h1>

                <div class="div_deg">
                <label for="room_number">first name</label>
                <input type="text" id="first_name" name="first_name" value="{{ old('first_name', $data->first_name) }}" required>

               </div>

               <div class="div_deg">
                <label for="last_name">last_name</label>
                <input type="text" id="last_name" name="last_name" value="{{ old('last_name', $data->last_name) }}" required>

               </div>
              
            <div class="div_deg">
                <label for="email">email</label>
                <textarea id="email" name="email" rows="3" required> {{($data->email)}}</textarea>
            </div>
            <div class="div_deg">
                <label for="phone">phone</label>
                <input type="number" id="phone" name="phone" step="0.01" value="{{($data->phone)}}" required >
            </div>
            
          <div class="div_deg">  
        <label for="address">address</label>
        <input type="text" id="address" name="address" value="{{ old('address', $data->address) }}" required>
    </div>
    <div class="div_deg">  
        <label for="department">department</label>
        <input type="text" id="department" name="department" value="{{ old('department', $data->department) }}" required>
    </div>
    <div class="div_deg">  
        <label for="hire_date">hire_date</label>
        <input type="date" id="hire_date" name="hire_date" value="{{ old('hire_date', $data->hire_date) }}" required>
    </div>
    <div class="div_deg">  
        <label for="employment_status">employment_status</label>
        <input type="text" id="employment_status" name="employment_status" value="{{ old('employment_status', $data->employment_status) }}" required>
    </div>

   
   
    
    

<div class="div_deg">>
    <label for="profile_picture">profile_picture</label>
    <input type="file" id="profile_picture" name="profile_picture" accept="image/*">
</div>
<div>
        <button type="submit">Update employee</button>
    </div>
    
    </form>
       
              </div>
            </div>
        </div>
    

  
    @include('admin.footer')
    


  </body>
</html>




    <!-- Checkbox to toggle the 'available' status -->
    <label>
        <input type="hidden" name="available" value="0"> <!-- Ensures unchecked checkboxes send a value -->
        <input type="checkbox" name="available" value="1" {{ $data->status == 'available' ? 'checked' : '' }}>
        Available
    </label>
    
        <button type="submit">update Room</button>
    </form>
    

</body>
</html> --}}
