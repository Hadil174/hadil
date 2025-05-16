<!DOCTYPE html>
<html>
<head>
    <base href="/public">
    @include('home.css')
    <title>Booking Payment Confirmation</title>
    <style>
        body {
            background-color: #f8f8f8;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .payment-container {
            max-width: 650px;
            margin: 60px auto;
            background-color: #ffffff;
            border: 1px solid #e0e0e0;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
        }

        .payment-header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid #e0e0e0;
        }

        .payment-header h2 {
            color: #2c3e50;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .booking-details {
            margin: 25px 0;
        }

        .detail-item {
            display: flex;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px dashed #f0f0f0;
        }

        .detail-label {
            flex: 1;
            font-weight: 500;
            color: #555;
        }

        .detail-value {
            flex: 2;
            font-weight: 400;
            color: #2c3e50;
        }

        .button-group {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
            gap: 15px;
        }

        .btn {
            padding: 12px 25px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 500;
            font-size: 15px;
            text-align: center;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex: 1;
        }

        .btn-pay {
            background-color: #003087; /* PayPal blue */
            color: white;
        }

        .btn-pay:hover {
            background-color: #002366;
        }

        .btn-return {
            background-color: #6c757d; /* Neutral gray */
            color: white;
            border: 1px solid #6c757d;
        }

        .btn-return:hover {
            background-color: #5a6268;
        }

        .btn i {
            margin-right: 8px;
        }

        @media (max-width: 576px) {
            .button-group {
                flex-direction: column;
            }
            
            .btn {
                width: 100%;
                margin-bottom: 10px;
            }
        }
    </style>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    @include('home.header')

    <div class="payment-container">
        <div class="payment-header">
            <h2>Booking Payment Confirmation</h2>
            <p>Please review your booking details before proceeding</p>
        </div>

        <div class="booking-details">
            <div class="detail-item">
                <div class="detail-label">Room Type:</div>
                <div class="detail-value">{{ $room->room_title }}</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Check-in Date:</div>
                <div class="detail-value">{{ date('F j, Y', strtotime($startDate)) }}</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Check-out Date:</div>
                <div class="detail-value">{{ date('F j, Y', strtotime($endDate)) }}</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Total Amount:</div>
                <div class="detail-value">{{ number_format($totalAmount, 2) }} DZD</div>

            </div>
        </div>

        <form method="POST" action="{{ route('handle.payment') }}">
            @csrf
            <input type="hidden" name="room_id" value="{{ $room->id }}">
            <input type="hidden" name="start_date" value="{{ $startDate }}">
            <input type="hidden" name="end_date" value="{{ $endDate }}">
            <input type="hidden" name="amount" value="{{ $room->price_per_night }}">
            
            <div class="button-group">
                <a href="/room_details" class="btn btn-return">
                    <i class="fas fa-arrow-left"></i> Return to Room
                </a>
                <button type="submit" class="btn btn-pay">
                    <i class="fab fa-paypal"></i> Proceed to Payment
                </button>
            </div>
        </form>
    </div>

    @include('home.footer')
</body>
</html>