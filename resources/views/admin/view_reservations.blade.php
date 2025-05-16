<!DOCTYPE html>
<html>
<head> 
    @include('admin.css')
    <style type="text/css">
        body {
            background-color: #121212;
            color: #f0f0f0;
            font-family: 'Segoe UI', sans-serif;
        }

        .table-wrapper {
            margin: 40px auto;
            padding: 10px;
            background-color: #1e1e1e;
            border-radius: 10px;
            width: 95%;
            overflow-x: auto;
            box-shadow: 0 0 10px rgba(0,0,0,0.6);
        }

        .table_deg {
            width: 100%;
            border-collapse: collapse;
            min-width: 900px; /* ensure minimum width for scrolling */
        }

        .th_deg {
            background-color: #2a2a2a;
            padding: 10px;
            font-weight: bold;
            color: #f8d1a1;
            border: 1px solid #444;
        }

        td {
            padding: 10px;
            border: 1px solid #444;
            text-align: center;
        }

        tr:hover {
            background-color: #2e2e2e;
        }

        .btn {
            padding: 5px 10px;
            font-size: 12px;
            border-radius: 4px;
            text-decoration: none;
        }

        .btn-danger {
            background-color: #dc3545;
            color: white;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }

        .btn-warning {
            background-color: #ffc107;
            color: black;
        }
    </style>
</head> 

<body>
    @include('admin.header')
    @include('admin.sidebar')

    <div class="page-content">
        <div class="container-fluid">
            <div class="table-wrapper">
                <table class="table_deg">
                    <thead>
                        <tr>
                            <th class="th_deg">Room ID</th>
                            <th class="th_deg">Customer Name</th>
                            <th class="th_deg">Email</th>
                            <th class="th_deg">Phone</th>
                            <th class="th_deg">Arrival Date</th>
                            <th class="th_deg">Leaving Date</th>
                            <th class="th_deg">Status</th>
                            <th class="th_deg">Room Number</th>
                            <th class="th_deg"> Total Price</th>
                            <th class="th_deg">Delete</th>
                            <th class="th_deg">Status Update</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $data)
                        <tr>
                            <td>{{ $data->room_id }}</td>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->email }}</td>
                            <td>{{ $data->phone }}</td>
                            <td>{{ $data->start_date }}</td>
                            <td>{{ $data->end_date }}</td>
                            <td>
                                @if ($data->status == 'approve')
                                    <span style="color:skyblue;">Approved</span>
                                @elseif ($data->status == 'rejected')
                                    <span style="color:red;">Rejected</span>
                                @else
                                    <span style="color:yellow;">Waiting</span>
                                @endif
                            </td>
                            <td>{{ $data->room->room_number }}</td>
                            <td>{{ $data->amount }} DA</td>
                            <td>
                                <a onclick="return confirm('Are you sure to delete this?');" href="{{ url('delete_booking', $data->id) }}" class="btn btn-danger">Delete</a>
                            </td>
                            <td>
                                <a href="{{ url('approve_book', $data->id) }}" class="btn btn-secondary" style="margin-bottom: 5px;">Approve</a>
                                <a href="{{ url('reject_book', $data->id) }}" class="btn btn-warning">Reject</a>
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
