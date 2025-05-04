<!DOCTYPE html>
<html>
<head>
    <base href="/public">
    @include('receptionist.css')
    <title>Today's Check-outs</title>
    <style>
        .status-badge {
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 0.8rem;
            font-weight: 500;
        }
        .badge-checked-in {
            background-color: #d1ecf1;
            color: #0c5460;
        }
        .badge-checked-out {
            background-color: #d4edda;
            color: #155724;
        }
        .badge-overdue {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>
    @include('receptionist.header')
    @include('receptionist.sidebar')

    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
                <div class="container-fluid">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2>Today's Check-outs ({{ $today->format('M d, Y') }})</h2>
                        <span class="badge badge-primary">{{ $checkouts->count() }} Guests</span>
                    </div>

                    <div class="card shadow">
                        <div class="card-body">
                            @if($checkouts->isEmpty())
                                <div class="alert alert-info">
                                    No check-outs scheduled for today.
                                    @php
                                        $nextCheckout = \App\Models\Booking::whereDate('end_date', '>', $today)
                                            ->where('is_checked_in', true)
                                            ->where('is_checked_out', false)
                                            ->orderBy('end_date')
                                            ->first();
                                    @endphp
                                    @if($nextCheckout)
                                        <br>Next check-out: {{ $nextCheckout->name }} on {{ $nextCheckout->end_date->format('M d') }}
                                    @endif
                                </div>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Guest</th>
                                                <th>Room</th>
                                                <th>Scheduled</th>
                                                <th>Actual</th>
                                                <th>Status</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($checkouts as $booking)
                                            <tr>
                                                <td>{{ $booking->name ?? 'N/A' }}</td>
                                                <td>
                                                    @if($booking->room)
                                                        {{ $booking->room->room_number }} ({{ $booking->room->room_type }})
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ $booking->end_date->format('h:i A') }}
                                                    @if($booking->end_date->isPast())
                                                        <span class="badge-overdue status-badge ml-2">Overdue</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($booking->check_out)
                                                        {{ $booking->check_out->format('h:i A') }}
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>
                                                    <span class="status-badge {{ $booking->is_checked_out ? 'badge-checked-out' : 'badge-checked-in' }}">
                                                        {{ $booking->is_checked_out ? 'Checked Out' : 'Checked In' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @if(!$booking->is_checked_out)
                                                        <a href="{{ route('bookings.checkout', $booking->id) }}" 
                                                           class="btn btn-sm btn-primary">
                                                            <i class="fas fa-sign-out-alt"></i> Check Out
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('receptionist.footer')
</body>
</html>