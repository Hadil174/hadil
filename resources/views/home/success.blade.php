<!DOCTYPE html>
<html>
<head>
    <base href="/public">
    @include('home.css')
    <title>Payment Confirmation</title>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .receipt-container {
            max-width: 650px;
            margin: 40px auto;
            background-color: #ffffff;
            border: 1px solid #e0e0e0;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 1px solid #e0e0e0;
            padding-bottom: 20px;
        }

        .header h2 {
            color: #2c3e50;
            margin-bottom: 5px;
            font-weight: 600;
        }

        .header p {
            color: #7f8c8d;
            font-size: 16px;
        }

        .receipt-details {
            margin: 30px 0;
        }

        .detail-row {
            display: flex;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px dashed #e0e0e0;
        }

        .detail-label {
            flex: 1;
            font-weight: 600;
            color: #555;
        }

        .detail-value {
            flex: 2;
            color: #2c3e50;
        }

        .button-group {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 30px;
        }

        .btn {
            padding: 12px 25px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 500;
            font-size: 15px;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-primary {
            background-color: #3498db;
            color: white;
        }

        .btn-primary:hover {
            background-color: #2980b9;
        }

        .btn-print {
            background-color: #2ecc71;
            color: white;
        }

        .btn-print:hover {
            background-color: #27ae60;
        }

        .btn i {
            margin-right: 8px;
        }

        @media print {
            body {
                background-color: #fff;
            }
            .receipt-container {
                border: none;
                box-shadow: none;
                padding: 0;
                max-width: 100%;
            }
            .button-group {
                display: none;
            }
        }
    </style>
</head>
<body>
    @include('home.header')

    <div class="receipt-container">
        <div class="header">
            <h2>PAYMENT CONFIRMATION</h2>
            <p>Your reservation has been successfully processed</p>
        </div>

        <div class="receipt-details">
            <div class="detail-row">
                <div class="detail-label">Booking Reference:</div>
                <div class="detail-value">{{ $booking->id }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Room Type:</div>
                <div class="detail-value">{{ $booking->room->room_title ?? 'N/A' }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Check-in Date:</div>
                <div class="detail-value">{{ date('F j, Y', strtotime($booking->start_date)) }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Check-out Date:</div>
                <div class="detail-value">{{ date('F j, Y', strtotime($booking->end_date)) }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Duration:</div>
                <div class="detail-value">{{ $booking->nights }} night(s)</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Amount Paid:</div>
                <div class="detail-value">{{ number_format($booking->amount, 2) }} DZD</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Payment Method:</div>
                <div class="detail-value">{{ ucfirst(str_replace('_', ' ', $booking->payment_method)) }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Transaction ID:</div>
                <div class="detail-value">{{ $booking->transaction_id ?? 'N/A' }}</div>
            </div>
            <div class="detail-row" style="border-bottom: none;">
                <div class="detail-label">Status:</div>
                <div class="detail-value" style="color: #27ae60; font-weight: 600;">CONFIRMED</div>
            </div>
        </div>

        <div class="button-group">
            <a href="/" class="btn btn-primary">
                <i class="fas fa-home"></i> Return Home
            </a>
            <button onclick="window.print()" class="btn btn-print">
                <i class="fas fa-print"></i> Print Receipt
            </button>
        </div>
    </div>

    @include('home.footer')

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <script>
        // Print button functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Add date printed when printing
            window.onafterprint = function() {
                // Optional: You can add confirmation message here
            };
        });
    </script>
</body>
</html>