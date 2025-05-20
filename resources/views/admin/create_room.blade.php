
<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')
    <style type="text/css">
        label {
            display: inline-block;
            width: 200px;
            margin-bottom: 10px;
        }
    
        .div_deg {
            padding: 10px 0;
        }
    
        .form-container {
            background-color: #f8f9fa;
            padding: 30px;
            border-radius: 10px;
            max-width: 600px;
            margin: 40px auto; /* ✅ Center horizontally */
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
    
        .div_centre {
            text-align: center;
            padding-bottom: 20px;
        }
    
        input[type="text"],
        input[type="number"],
        input[type="file"],
        textarea,
        select {
            width: calc(100% - 210px); /* Match label + spacing */
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
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
            background-color: #388e3c;
        }
    
        .success-message {
            background-color: #d4edda;
            padding: 10px;
            color: #155724;
            border: 1px solid #c3e6cb;
            border-radius: 5px;
            margin-top: 20px;
            text-align: center;
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
                    @csrf  
                    @if(session('success'))
                    <div style="background-color: #d4edda; padding: 10px; color: #155724; border: 1px solid #c3e6cb; border-radius: 5px; margin-bottom: 20px;">
                        {{ session('success') }}
                    </div>
                    @endif
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
                <label for="price_per_night">Price per Night (DA):</label>
                <input type="number" id="price_per_night" name="price_per_night" step="0.01" required>
            </div>
            
            <div class="div_deg">  
                <label for="room_type">Room Type:</label>
                <select id="room_type" name="room_type" required>
                    <option value="">-- Select Room Type --</option>
                    <option value="single">Single – One bed, ideal for one person</option>
                    <option value="double">Double – One double bed, for two people</option>
                    <option value="twin">Twin – Two separate beds</option>
                    <option value="suite">Suite – Luxury room with living area</option>
                    <option value="family">Family – Accommodates 3–4 people, multiple beds</option>
                    <option value="deluxe">Deluxe – Enhanced amenities and space</option>
                    <option value="presidential">Presidential Suite – Top-tier luxury</option>
                </select>
            </div>
            
   
    <div class="div_deg">
        <label for="status">Room Status:</label>
        <select id="status" name="status" required>
            <option value="available">Available</option>
            <option value="occupied">Occupied</option>
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
   

    </form>
       
              </div>
            </div>
        </div>
    

  
    @include('admin.footer')
    


  </body>
</html>

