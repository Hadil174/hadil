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
            min-width: 900px;
        }

        .th_deg {
            background-color: #2a2a2a;
            padding: 10px;
            color: #f8d1a1;
            font-weight: bold;
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

        img {
            border-radius: 6px;
        }

        .btn {
            padding: 6px 10px;
            font-size: 12px;
            border-radius: 4px;
            text-decoration: none;
        }

        .btn-danger {
            background-color: #dc3545;
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
                            <th class="th_deg">Room Number</th>
                            <th class="th_deg">Room Title</th>
                            <th class="th_deg">Room Type</th>
                            <th class="th_deg">Price (Per Night)</th>
                            <th class="th_deg">Status</th>
                            <th class="th_deg">Description</th>
                            <th class="th_deg">Image</th>
                            <th class="th_deg">Delete</th>
                            <th class="th_deg">Update</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $room)
                        <tr>
                            <td>{{ $room->room_number }}</td>
                            <td>{{ $room->room_title }}</td>
                            <td>{{ $room->room_type }}</td>
                            <td>{{ $room->price_per_night }} Da</td>
                            <td>{{ $room->status }}</td>
                            <td>{!! \Illuminate\Support\Str::limit($room->description, 150) !!}</td>
                            <td>
                                <img width="60" src="room/{{ $room->images }}" alt="Room Image">
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
