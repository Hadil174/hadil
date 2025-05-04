
<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')
    <style type="text/css">
        .table_deg{
            border: 2px solid white;
            margin: auto;
            width: 50%;
            text-align: center;
            margin-top: 40px;
        }
        .th_deg{
            background-color: rgb(248, 209, 161);
            padding: 6px;

        }
        tr{
            border: 2px solid white ;
        }
        td{
            padding: 9px;
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
                        
                        <th class="th_deg">room_id</th>
                        <th class="th_deg">customer name</th>
                        <th class="th_deg">Email</th>
                        <th class="th_deg" > Phone </th>
                        <th  class="th_deg" >Arrival Date</th>
                        <th  class="th_deg">Leaving Date</th>
                        <th  class="th_deg">status</th>
                        <th  class="th_deg"> Room Number</th>
                        <th  class="th_deg"> Price</th>
                        <th  class="th_deg"> Delete</th>
                        <th  class="th_deg">status update</th>

                        
                      
                  
                    </tr>
                </thead>
                <tbody>
                  @foreach($data as $data)
                    <tr>
                        <td>{{$data->room_id}} </td>
                        <td> {{$data->name}}</td>
                        <td>{{$data->email}}</td>
                        <td>{{$data->phone}}</td>
                        <td>{{$data->start_date}}</td>
                        <td>{{$data->end_date}}</td>
                        <td> 
                            @if ($data->status == 'approve')
                            <span style="color:skyblue;">Approved</span>
                            @endif
                    
                            @if ($data->status == 'rejected')
                            <span style="color:red;">Rejected</span>
                            @endif
                    
                            @if ($data->status == 'waiting')
                            <span style="color:yellow;">Waiting</span>
                            @endif
                        </td>
                        <td>{{$data->room->room_number}}</td>
                        <td>{{$data->room->price_per_night}}</td>
                        <td> <a onclick="return confirm ('Are you sure to delete this') ;" href="{{ url('delete_booking', $data->id) }}" class="btn btn-danger">Delete</a></td>
                        <td>
                            <a href="{{ url('approve_book', $data->id) }}" class="btn btn-secondary" style="margin-bottom: 5px;">Approve</a>
                            <a href="{{ url('reject_book', $data->id) }}" class="btn btn-warning">Rejected</a>
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
