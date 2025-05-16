<!DOCTYPE html>
<html lang="en">
<head>
    <base href="/public">
    @include('receptionist.css')
    <style type="text/css">
        body {
            background-color: #121212;
            color: #e2e8f0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .page-content { padding: 40px 0; }
        .card {
            max-width: 650px;
            margin: 40px auto;
            padding: 35px;
            background: #1e1e2f;
            border-radius: 15px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.6);
            color: #e2e8f0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .card h2 {
            color: #90cdf4;
            font-weight: 700;
            letter-spacing: 2px;
            text-align: center;
            margin-bottom: 30px;
        }
        .card p { margin: 10px 0; }
        hr {
            border-color: #63b3ed;
            opacity: 0.4;
            margin: 25px 0;
        }
        .total {
            color: #63b3ed;
            font-size: 1.3rem;
            font-weight: 600;
        }
        .btn-back {
            display: inline-block;
            background: #3182ce;
            color: white;
            padding: 12px 30px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            box-shadow: 0 6px 15px rgba(49, 130, 206, 0.5);
            transition: background 0.3s ease;
            text-align: center;
            margin: 0 auto;
            display: block;
            width: fit-content;
        }
        .btn-back:hover {
            background: #2b6cb0;
        }
        @media (max-width: 768px) {
            .card {
                padding: 25px;
                margin: 20px;
            }
        }
    </style>
</head>
<body>
    @include('receptionist.header')
    @include('receptionist.sidebar')

    <div class="page-content">
        <div class="container-fluid">
            <div class="card">
                <h2>Booking Receipt</h2>

                <p><strong>Room:</strong> {{ $room->room_title }} ({{ $room->room_number }})</p>
                <p><strong>Type:</strong> {{ $room->room_type }}</p>
                <p><strong>Price per Night:</strong> {{ number_format($room->price_per_night, 2) }} DA</p>
                <p><strong>Check-in Date:</strong> {{ \Carbon\Carbon::parse($booking->start_date)->format('d M Y') }}</p>
                <p><strong>Check-out Date:</strong> {{ \Carbon\Carbon::parse($booking->end_date)->format('d M Y') }}</p>

                @php
                    $nights = \Carbon\Carbon::parse($booking->start_date)->diffInDays($booking->end_date);
                    $roomTotal = $room->price_per_night * $nights;

                    // Use $additionalServicePrice passed from controller if exists, else fallback to booking property or 0
                    $additionalServicePrice = $additionalServicePrice ?? ($booking->additional_service_price ?? 0);
                    $total = $roomTotal + $additionalServicePrice;
                @endphp

                <p><strong>Nights:</strong> {{ $nights }}</p>

                @if($additionalServicePrice > 0)
                    <p><strong>Additional Services Price:</strong> {{ number_format($additionalServicePrice, 2) }} DA</p>
                @else
                    <p><em>No additional services</em></p>
                @endif

                <hr>
                <h4 class="total"><strong>Total:</strong> {{ number_format($total, 2) }} DA</h4>
            </div>
        </div>
    </div>

    @include('receptionist.footer')
</body>
</html>
