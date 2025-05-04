<!DOCTYPE html>
<html>
<head>
    <base href="/public">
    @include('home.css')
    <title>Confirm Payment</title>
    <style>
        body {
            background-color: #ffffff; /* clean white */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
        }

        .payment-container {
            max-width: 600px;
            margin: 60px auto;
            background-color: #ffffff;
            border-left: 8px solid #b8860b; /* golden brown */
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        .payment-container h2 {
            text-align: center;
            color: #8b4513; /* saddle brown */
            margin-bottom: 20px;
        }

        .payment-container p {
            font-size: 16px;
            color: #4b3621; /* deep brown */
            margin: 10px 0;
        }

        .paypal-btn {
            background-color: #d2b48c; /* beige/golden tone */
            color: #fff;
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            font-size: 16px;
            margin-top: 20px;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        .paypal-btn:hover {
            background-color: #b8860b; /* dark goldenrod */
        }
    </style>
</head>
<body>
    @include('home.header')

    <div class="payment-container">
        <h2>Booking Confirmation</h2>

        <p><strong>Room:</strong> {{ $room->room_title }}</p>
        <p><strong>Dates:</strong> {{ $startDate }} to {{ $endDate }}</p>
        <p><strong>Price:</strong> {{ $room->price_per_night }} DZD</p>

        <form method="POST" action="{{ route('paypal') }}">
            @csrf
            <input type="hidden" name="room_id" value="{{ $room->id }}">
            <input type="hidden" name="start_date" value="{{ $startDate }}">
            <input type="hidden" name="end_date" value="{{ $endDate }}">
            <input type="hidden" name="amount" value="{{ $room->price_per_night }}">
        
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email Address" required>
            <input type="text" name="phone" placeholder="Phone Number" required>
        
            <button type="submit" class="paypal-btn">Pay with PayPal</button>
        </form>
        
    </div>

    @include('home.footer')
</body>
</html>
