<!DOCTYPE html>
<html>
<head>
    <base href="/public">
    @include('receptionist.css')
    <title>Today's Check-ins</title>
</head>
<body>
    @include('receptionist.header')
    @include('receptionist.sidebar')

    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
                <div class="container-fluid">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2>Today's Check-ins ({{ now()->format('M d, Y') }})</h2>
                        <span class="badge badge-primary">{{ $checkins->count() }} Guests</span>
                    </div>

                    <div class="card shadow">
                        <div class="card-body">
                            @if($checkins->isEmpty())
                                <div class="alert alert-info">No check-ins scheduled for today.</div>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Guest</th>
                                                <th>Room</th>
                                                <th>Check-in Time</th>
                                                <th>Nights</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($checkins as $booking)
                                            <tr>
                                                <td>{{ $booking->name ?? 'N/A' }}</td>
                                                <td>
                                                    @if($booking->room)
                                                        {{ $booking->room->room_number }} ({{ $booking->room->room_type }})
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                <td>{{ $booking->start_date ? \Carbon\Carbon::parse($booking->start_date)->format('h:i A') : 'N/A' }}</td>
                                                <td>
                                                    @if($booking->start_date && $booking->end_date)
                                                        {{ \Carbon\Carbon::parse($booking->start_date)->diffInDays($booking->end_date) }}
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                <td>
                                                    <span class="badge badge-warning">Expected</span>
                                                </td>
                                                <td>
                                                    @if(!$booking->is_checked_in)
                                                        <a href="{{ route('bookings.checkin', $booking->id) }}" class="btn btn-sm btn-success">
                                                            <i class="fas fa-sign-in-alt"></i> Check In
                                                        </a>
                                                    @else
                                                        <span class="badge badge-success">Already Checked In</span>
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