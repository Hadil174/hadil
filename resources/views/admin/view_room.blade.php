    
    <!DOCTYPE html>
    <html>
      <head> 
        @include('admin.css')
        <style type="text/css">
        .table_deg{
            border: 2px solid white;
            margin: auto;
            width: 100%;
            text-align: center;
            margin-top: 40px;
        }
        .th_deg{
            background-color: rgb(248, 209, 161);
            padding: 10px;

        }
        tr{
            border: 3px solid white ;
        }
        td{
            padding: 10px;
        }

        </style>
      </head> 
     
      
      <body>
        @include('admin.header')
        @include('admin.sidebar')
        <div class="page-content">
            <div class="page-header">
              <div class="container-fluid">
                <table class="table_deg">
                    <thead>
                        <tr>
                            
                            <th class="th_deg">Room Number</th>
                            <th class="th_deg">Room title</th>
                            <th class="th_deg">Room Type</th>
                            <th class="th_deg" >Price (Per Night)</th>
                            <th  class="th_deg" >Status</th>
                            <th  class="th_deg">description</th>
                            <th  class="th_deg">image</th>
                            {{-- <th>image</th> --}}
                            <th  class="th_deg">delete</th>
                            <th  class="th_deg">update</th>
                      
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $room)
                        <tr>
                            <td>{{ $room->room_number }}</td>
                            <td>{{ $room->room_title }}</td>
                            <td>{{ $room->room_type }}</td>
                            <td>{{ $room->price_per_night }}Da</td>
                                <td>{{ $room->status }}</td>
                                          
                            <td>{!! \Illuminate\Support\Str::limit($room->description, 150) !!}
                            </td>
                            <td>
                                <img width="60" src="room/{{$room->images}}" >
                            </td>
                            <td>
                                <a class="btn btn-danger" href="{{ url('room_delete', $room->id) }}">Delete</a>
                            </td>
                            <td>
                                <a class="btn btn-warning" href="{{ url('room_update', $room->id) }}">Update</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    
                </table>
                </div>
            </div>
        </div>

        
        @include('admin.footer')
      </body>
    </html> 
    
    
    
    
    
