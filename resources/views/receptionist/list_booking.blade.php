<!DOCTYPE html>
<html lang="en">
<head>
    @include('receptionist.css')
    <title>Today’s Check-ins</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            background-color: #121212;
            color: #e0e0e0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container-fluid {
            padding: 40px 20px;
            max-width: 1200px;
            margin: auto;
        }

        .table-card {
            background-color: #1e1e1e;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.5);
        }

        h4 {
            color: #fff;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        thead {
            background-color: #2c2c2c;
            color: #ffffff;
        }

        thead th {
            padding: 14px;
            font-size: 0.9rem;
            text-align: left;
        }

        tbody tr:nth-child(odd) {
            background-color: #1a1a1a;
        }

        tbody td {
            padding: 12px 14px;
            font-size: 0.88rem;
            vertical-align: middle;
        }

        .badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .badge-pending {
            background-color: #ff9800;
            color: #fff;
        }

        .badge-checkedin {
            background-color: #4caf50;
            color: #fff;
        }

        .badge-checkedout {
            background-color: #2196f3;
            color: #fff;
        }

        .btn {
            padding: 6px 12px;
            font-size: 0.8rem;
            font-weight: 600;
            border-radius: 5px;
            color: #fff;
            text-decoration: none;
            margin-right: 6px;
            display: inline-block;
        }

        .btn-success {
            background-color: #4caf50;
        }

        .btn-info {
            background-color: #2196f3;
        }

        .btn-danger {
            background-color: #f44336;
        }

        .btn-secondary {
            background-color: #757575;
            cursor: not-allowed;
        }

        .actions {
            white-space: nowrap;
        }
        header {
    height: 130px;
    overflow: hidden;
}


    </style>
</head>
<body>
@include('receptionist.header')
@include('receptionist.sidebar')

<div class="page-content">
    <div class="container-fluid">
        <div class="table-card">
            <h4>Today’s Check-ins</h4>
            <table>
                <thead>
                    <tr>
                       
                        <th>Guest</th>
                        <th>Room</th>
                        <th>Dates</th>
                        <th>Status</th>
                        <th>Contact</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $index => $item)
                    <tr>
                       
                        <td>
                            <strong>{{ $item->name }}</strong><br>
                            <small>{{ $item->email }}</small>
                        </td>
                        <td>Room {{ $item->room->room_number }}</td>
                        <td>
                            <div>From: {{ $item->start_date }}</div>
                            <div>To: {{ $item->end_date }}</div>
                        </td>
                        <td>
                            <span class="badge 
                                {{ $item->is_checked_out ? 'badge-checkedout' : ($item->is_checked_in ? 'badge-checkedin' : 'badge-pending') }}">
                                {{ $item->is_checked_out ? 'Checked Out' : ($item->is_checked_in ? 'Checked In' : 'Pending') }}
                            </span>
                        </td>
                        <td>
                            <div><i class="fas fa-phone"></i> {{ $item->phone }}</div>
                            @if ($item->check_in)
                                <div><i class="fas fa-sign-in-alt"></i> {{ $item->check_in->format('Y-m-d H:i') }}</div>
                            @endif
                            @if ($item->check_out)
                                <div><i class="fas fa-sign-out-alt"></i> {{ $item->check_out->format('Y-m-d H:i') }}</div>
                            @endif
                        </td>
                        <td class="actions">
                            <a href="{{ url('delete_booking', $item->id) }}" class="btn btn-danger"
                               onclick="return confirm('Are you sure to delete this booking?')">
                                <i class="fas fa-trash-alt"></i>
                            </a>

                            @if (!$item->is_checked_in)
                                <a href="{{ url('receptionist/checkin', $item->id) }}" class="btn btn-success">
                                    <i class="fas fa-sign-in-alt"></i>
                                </a>
                            @elseif (!$item->is_checked_out)
                                <a href="{{ url('receptionist/checkout', $item->id) }}" class="btn btn-info">
                                    <i class="fas fa-sign-out-alt"></i>
                                </a>
                            @else
                                <span class="btn btn-secondary"><i class="fas fa-check-circle"></i></span>
                            @endif
                        </td>
                    </tr>
                    @endforeach

                    @if($data->isEmpty())
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 20px;">No bookings found for today.</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

@include('receptionist.footer')
</body>
</html>
