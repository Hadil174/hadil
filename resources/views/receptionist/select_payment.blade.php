<!DOCTYPE html>
<html lang="en">
<head>
    <base href="/public">
    @include('receptionist.css')
    <style>
        body {
            background-color: #f3f4f6;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .page-content {
            padding: 40px 0;
        }

        .payment-card {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
        }

        .payment-card h3 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 26px;
            font-weight: 600;
            color: #2d3748;
            position: relative;
        }

        .payment-card h3::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background: #4299e1;
            border-radius: 2px;
        }

        .payment-option {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
            margin-top: 20px;
        }

        .payment-option form {
            flex: 1 1 45%;
        }

        .payment-btn {
            width: 100%;
            padding: 18px;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-dark {
            background: #2d3748;
            color: #fff;
        }

        .btn-dark:hover {
            background: #1a202c;
            transform: translateY(-2px);
            box-shadow: 0 6px 14px rgba(0, 0, 0, 0.2);
        }

        .btn-primary {
            background: #4299e1;
            color: #fff;
        }

        .btn-primary:hover {
            background: #3182ce;
            transform: translateY(-2px);
            box-shadow: 0 6px 14px rgba(66, 153, 225, 0.4);
        }

        @media (max-width: 768px) {
            .payment-option {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    @include('receptionist.header')
    @include('receptionist.sidebar')

    <div class="page-content">
        <div class="container">
            <div class="payment-card">
                <h3>Choose Payment Method</h3>

                <div class="payment-option">
                    <!-- Pay at Reception Form -->
                    <form action="{{ url('/receptionist/pay-on-site') }}" method="POST">
                        @csrf
                        <input type="hidden" name="room_id" value="{{ $room->id }}">
                        <input type="hidden" name="start_date" value="{{ $startDate }}">
                        <input type="hidden" name="end_date" value="{{ $endDate }}">
                        <input type="hidden" name="name" value="{{ session('pending_booking.name') }}">
                        <input type="hidden" name="email" value="{{ session('pending_booking.email') }}">
                        <input type="hidden" name="phone" value="{{ session('pending_booking.phone') }}">

                        <button type="submit" class="payment-btn btn-dark">Pay at Reception</button>
                    </form>

                    <!-- Pay with Card Form -->
                    <form action="{{ route('handle.payment') }}" method="POST">
                        @csrf
                        <input type="hidden" name="room_id" value="{{ $room->id }}">
                        <input type="hidden" name="start_date" value="{{ $startDate }}">
                        <input type="hidden" name="end_date" value="{{ $endDate }}">

                        <button type="submit" class="payment-btn btn-primary">Pay with Card</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('receptionist.footer')
</body>
</html>
