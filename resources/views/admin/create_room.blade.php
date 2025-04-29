
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

  
  <body>
        
    @include('admin.header')
    @include('admin.sidebar')

   
        <div class="page-content">
            <div class="page-header">
              <div class="container-fluid">
                <form action="{{ url('/add_room') }}" method="POST" enctype="multipart/form-data">
                    @csrf  <!-- ✅ Add this line to include CSRF token -->
                    <div class="div_centre">
                        <h1 style="font-size: 30px ;font-wight:bold;">Add Rooms </h1>

                <div class="div_deg">
                <label for="room_number">Room Number:</label>
                <input type="text" id="room_number" name="room_number" required>
               </div>
               <div class="div_deg">
                <label for="room_title">Room title:</label>
                <input type="text" id="room_title" name="room_title" required>
               </div>


              
            <div class="div_deg">
                <label for="description">Description:</label>
                <textarea id="description" name="description" rows="3" required></textarea>
            </div>
            <div class="div_deg">
                <label for="price_per_night">Price per Night ($):</label>
                <input type="number" id="price_per_night" name="price_per_night" step="0.01" required>
            </div>
            
          <div class="div_deg">  
        <label for="room_type">Room Type:</label>
        <select id="room_type" name="room_type" required>
            <option value="single">Single</option>
            <option value="double">Double</option>
            <option value="suite">Suite</option>
        </select>
    </div>
   
    <div class="div_deg">
        <label for="status">Room Status:</label>
        <select id="status" name="status" required>
            <option value="available">Available</option>
            <option value="occupied">Occupied</option>
            <option value="maintenance">Maintenance</option>
            <option value="housekeeping">Housekeeping</option>
            <option value="out_of_order">Out of Order</option>
        </select>
    </div>
    

<div class="div_deg">>
    <label for="image">Room Image:</label>
    <input type="file" id="image" name="images" accept="image/*">
</div>
<div>
        <button type="submit">Add Room</button>
    </div>
    @if(session('success'))
    <div style="background-color: #d4edda; padding: 10px; color: #155724; border: 1px solid #c3e6cb; border-radius: 5px; margin-bottom: 20px;">
        {{ session('success') }}
    </div>
@endif
    </form>
       
              </div>
            </div>
        </div>
    

  
    @include('admin.footer')
    


  </body>
</html>

