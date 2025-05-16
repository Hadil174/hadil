<!DOCTYPE html>
<html>
<head>
    <base href="/public">
    @include('receptionist.css')
    <style type="text/css">
        body {
            background-color: #121212;
            color: #e2e8f0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .page-content {
            padding: 40px 0;
        }

        .booking-container {
            max-width: 650px;
            margin: 0 auto;
            padding: 35px;
            background: #1e1e2f;
            border-radius: 15px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.5);
        }

        .booking-header {
            text-align: center;
            margin-bottom: 35px;
            color: #90cdf4;
            font-size: 30px;
            font-weight: bold;
            position: relative;
            padding-bottom: 12px;
        }

        .booking-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 3px;
            background: #63b3ed;
            border-radius: 50px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #cbd5e0;
            font-size: 15px;
        }

        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #2d3748;
            border-radius: 10px;
            font-size: 15px;
            background-color: #2d3748;
            color: #e2e8f0;
            transition: all 0.3s;
        }

        .form-group input:focus {
            border-color: #63b3ed;
            box-shadow: 0 0 0 3px rgba(99, 179, 237, 0.3);
            outline: none;
            background-color: #1a202c;
        }

        .btn-book {
            width: 100%;
            padding: 14px;
            background: #3182ce;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 17px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-book:hover {
            background: #2b6cb0;
            transform: scale(1.02);
            box-shadow: 0 4px 14px rgba(49, 130, 206, 0.4);
        }

        .room-info {
            background: #2c5282;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 30px;
            color: #f7fafc;
        }

        .room-info h3 {
            margin-top: 0;
            margin-bottom: 10px;
            font-size: 22px;
            font-weight: bold;
            color: #bee3f8;
        }

        .room-info p {
            margin: 5px 0;
            color: #e2e8f0;
        }

        .room-info .price {
            font-size: 18px;
            font-weight: 600;
            color: #90cdf4;
        }

        .alert-error {
            background-color: #e53e3e;
            color: white;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .booking-container {
                padding: 25px;
            }

            .booking-header {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    @include('receptionist.header')
    @include('receptionist.sidebar')
    
    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
                <div class="booking-container">
                    <div class="booking-header">Book Your Room</div>

                    <!-- Error message if room is already booked -->
                    @if(session('error'))
                        <div class="alert-error">
                            {{ session('error') }}
                        </div>
                    @endif
                    
                    <!-- Room Information -->
                    <div class="room-info">
                        <h3>{{ $room->room_title }}</h3>
                        <p><strong>Type:</strong> {{ $room->room_type }}</p>
                        <p><strong>Number:</strong> {{ $room->room_number }}</p>
                        <p class="price"><strong>Price:</strong> {{ $room->price_per_night }} DA per night</p>
                    </div>
                    
                    <form action="{{ route('process.booking', $room->id) }}" method="post">
                        @csrf
                        
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" name="name" id="name" required placeholder="Enter your full name">
                        </div>
                        
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" name="email" id="email" required placeholder="Enter your email">
                        </div>
                        
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="tel" name="phone" id="phone" required placeholder="Enter your phone number">
                        </div>
                        
                        <div class="form-group">
                            <label for="startDate">Check-in Date</label>
                            <input type="date" name="startDate" id="startDate" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="endDate">Check-out Date</label>
                            <input type="date" name="endDate" id="endDate" required>
                        </div>
                        
                        <div class="form-group">
                            <input type="submit" class="btn-book" value="Confirm Booking">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('receptionist.footer')
    
    <script type="text/javascript">
        $(function() {
            var dtToday = new Date();
            
            var month = dtToday.getMonth() + 1;
            var day = dtToday.getDate();
            var year = dtToday.getFullYear();
            
            if(month < 10) month = '0' + month.toString();
            if(day < 10) day = '0' + day.toString();
            
            var minDate = year + '-' + month + '-' + day;
            
            $('#startDate').attr('min', minDate);
            $('#endDate').attr('min', minDate);
            
            $('#startDate').change(function() {
                var startDate = $(this).val();
                $('#endDate').attr('min', startDate);
            });
        });
    </script>
</body>
</html>
