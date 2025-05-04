<!DOCTYPE html>
<html lang="en">
<head>
    @include('receptionist.css')
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7fa;
            color: #333;
        }

        .container-fluid {
            margin-top: 30px;
            max-width: 900px;
        }

        .reservation-card {
            background-color: #fff;
            border-radius: 6px;
            box-shadow: 0 1px 6px rgba(0,0,0,0.1);
            margin-bottom: 10px;
            overflow: hidden;
            cursor: pointer;
            transition: box-shadow 0.3s ease;
        }

        .reservation-card:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        .reservation-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 18px;
            background-color: #f9fafc;
            border-bottom: 1px solid #eee;
        }

        .reservation-header h5 {
            font-size: 1rem;
            margin: 0;
            color: #3f51b5;
            font-weight: 600;
        }

        .status-badge {
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .status-checkedout {
            background-color: #2196f3;
            color: #fff;
        }

        .status-checkedin {
            background-color: #4caf50;
            color: #fff;
        }

        .status-pending {
            background-color: #ffc107;
            color: #fff;
        }

        .reservation-body {
            padding: 15px 20px;
            display: none;
            animation: fadeIn 0.3s ease;
        }

        .reservation-body p {
            margin: 4px 0;
            font-size: 0.9rem;
        }

        .action-buttons {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 12px;
        }

        .btn {
            padding: 6px 14px;
            border-radius: 5px;
            font-size: 0.85rem;
            text-decoration: none;
            color: #fff;
            font-weight: 500;
            margin-right: 8px;
        }

        .btn-success {
            background-color: #4caf50;
        }

        .btn-info {
            background-color: #3f51b5;
        }

        .btn-danger {
            background-color: #f44336;
        }

        .btn-secondary {
            background-color: #aaa;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-5px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>


    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll(".reservation-card").forEach(card => {
                card.querySelector(".reservation-header").addEventListener("click", () => {
                    const body = card.querySelector(".reservation-body");
                    body.style.display = (body.style.display === "block") ? "none" : "block";
                });
            });
        });
    </script>
</head>

<body>
    @include('receptionist.header')
    @include('receptionist.sidebar')

    <div class="page-content">
        <div class="container-fluid">
           

            @foreach($data as $data)
            <div class="reservation-card">
                <div class="reservation-header">
                    <h5>{{ $data->name }} - Room {{ $data->room->room_number }}</h5>
                    <span class="status-badge 
                        @if($data->is_checked_out) status-checkedout 
                        @elseif($data->is_checked_in) status-checkedin 
                        @else status-pending @endif">
                        @if($data->is_checked_out) Checked-Out
                        @elseif($data->is_checked_in) Checked-In
                        @else Pending
                        @endif
                    </span>
                </div>

                <div class="reservation-body">
                    <p><strong>Email:</strong> {{ $data->email }}</p>
                    <p><strong>Phone:</strong> {{ $data->phone }}</p>
                    <p><strong>Arrival:</strong> {{ $data->start_date }}</p>
                    <p><strong>Leaving:</strong> {{ $data->end_date }}</p>
                    <p><strong>Price per Night:</strong> {{ $data->room->price_per_night }} DA</p>

                    <!-- Check if check_in is not null before displaying -->
                    @if ($data->is_checked_in && $data->check_in)
                        <p><strong>Checked In:</strong> {{ $data->check_in->format('Y-m-d H:i') }}</p>
                    @endif

                    <!-- Check if check_out is not null before displaying -->
                    @if ($data->is_checked_out && $data->check_out)
                        <p><strong>Checked Out:</strong> {{ $data->check_out->format('Y-m-d H:i') }}</p>
                    @endif

                    <div class="action-buttons">
                        <a href="{{ url('delete_booking', $data->id) }}" 
                           onclick="return confirm('Are you sure to delete this?');"
                           class="btn btn-danger">Delete</a>

                        <div>
                            @if (!$data->is_checked_in)
                                <a href="{{ url('receptionist/checkin', $data->id) }}" class="btn btn-success">Check-In</a>
                            @elseif ($data->is_checked_in && !$data->is_checked_out)
                                <a href="{{ url('receptionist/checkout', $data->id) }}" class="btn btn-info">Check-Out</a>
                            @else
                                <span class="btn btn-secondary" disabled>Done</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    @include('receptionist.footer')
</body>
</html>

