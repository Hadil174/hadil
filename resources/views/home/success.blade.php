<!DOCTYPE html>
<html>
<head>
    <base href="/public">
    @include('home.css')
    <title>Payment Successful</title>
    <style>
        body {
            background-color: #ffffff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
        }

        .success-container {
            max-width: 600px;
            margin: 60px auto;
            background-color: #ffffff;
            border-left: 8px solid #228B22; /* forest green */
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            text-align: center;
        }

        .success-container h2 {
            color: #2e8b57; /* sea green */
            margin-bottom: 15px;
        }

        .success-container p {
            font-size: 16px;
            color: #333;
            margin: 10px 0;
        }

        .success-container strong {
            color: #4b3621;
        }

        .home-btn {
            background-color: #8b4513; /* saddle brown */
            color: #fff;
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            font-size: 16px;
            margin-top: 20px;
            text-decoration: none;
            display: inline-block;
            transition: background-color 0.3s ease;
        }

        .home-btn:hover {
            background-color: #b8860b; /* goldenrod */
        }
    </style>
</head>
<body>
    @include('home.header')

    <div class="success-container">
        <h2>🎉 Payment Successful!</h2>
        <p>Your booking has been <strong>confirmed</strong>.</p>
        <p><strong>Room:</strong> {{ $booking->room->room_title ?? 'N/A' }}</p>
        <p><strong>Check-in:</strong> {{ $booking->start_date }}</p>
        <p><strong>Check-out:</strong> {{ $booking->end_date }}</p>
        <p><strong>Amount Paid:</strong> {{ $booking->amount  }} {{ $booking->currency ?? 'DZD' }}</p>
        <p><strong>Payment Method:</strong> {{ ucfirst($booking->payment_method) }}</p>
        <p><strong>Transaction ID:</strong> {{ $booking->transaction_id ?? 'N/A' }}</p>

        <a href="/" class="home-btn">Return Home</a>
    </div>

    @include('home.footer')
</body>
</html>
