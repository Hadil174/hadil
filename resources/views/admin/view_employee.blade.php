


<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')
    <style type="text/css">
        .table_deg{
            border: 2px solid white;
            margin: auto;
            width: 60%;
            max-width: 900px; 
            text-align: center;
            margin-top: 40px;
        }
        .th_deg{
            background-color: rgb(248, 209, 161);
            padding: 8px;

        }
        tr{
            border: 3px solid white ;
        }
        td{
            padding: 10px;
        }
        td, th {
    padding: 7px; /* reduce cell padding */
    font-size: 12px;    /* smaller font if needed */
    white-space: nowrap;
}

        </style>
  </head> 
  
  
  
  <body>
    @include('admin.header')
    @include('admin.sidebar')
    
    <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">
            <table>
                <thead>
                    <tr>
                        <th  class="th_deg">picture</th>
                        <th  class="th_deg">first name</th>
                        <th  class="th_deg">last name</th>
                        <th  class="th_deg">email </th>
                        <th  class="th_deg">phone</th>
                        <th  class="th_deg">address</th>
                        <th  class="th_deg">role</th>
                        <th  class="th_deg">Department</th>
                        <th  class="th_deg">Hire Date</th>
                        <th  class="th_deg">Status</th>
                       
                            {{-- <th>image</th> --}}
                            <th  class="th_deg">delete</th>
                            <th  class="th_deg">update</th>
                       
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $data)
                    <tr>
                        <td>{{$data->profile_picture}}</td>
                        <td>{{$data->first_name}}</td>
                        <td>{{$data->last_name}}</td>
                        <td>{{$data->email}}</td>
                        <td>{{$data->phone}}</td>
                        <td>{{$data->address}}</td>
                        <td>{{$data->role}}</td>
                        <td>{{$data->department}}</td>
                        <td>{{$data->hire_date}}</td>
                       
                        <td>{{$data->employment_status}}</td>
                        
                        <td>
                            <a  class="btn btn-danger" href="{{url('employee_delete',$data->id)}}">delete</a>
                        </td>
                        <td>
                            <a  class="btn btn-warning" href="{{url('employee_update',$data->id)}}">update</a>
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
