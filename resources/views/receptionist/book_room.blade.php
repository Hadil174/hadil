<!DOCTYPE html>
<html>
<head>
    <base href="/public">
    @include('receptionist.css')
    <style type="text/css">
        .page-content {
            background-color: #f8f9fa;
            padding: 30px 0;
        }
        
        .booking-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 30px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }
        
        .booking-header {
            text-align: center;
            margin-bottom: 30px;
            color: #4a5568;
            font-size: 28px;
            font-weight: 600;
            position: relative;
            padding-bottom: 15px;
        }
        
        .booking-header:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: #4299e1;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #4a5568;
            font-size: 14px;
        }
        
        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-size: 15px;
            transition: all 0.3s;
            background-color: #f8fafc;
        }
        
        .form-group input:focus {
            outline: none;
            border-color: #4299e1;
            box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.2);
            background-color: white;
        }
        
        .btn-book {
            width: 100%;
            padding: 14px;
            background: #4299e1;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .btn-book:hover {
            background: #3182ce;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(66, 153, 225, 0.3);
        }
        
        .room-info {
            background: #f0f9ff;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 25px;
            border-left: 4px solid #4299e1;
        }
        
        .room-info h3 {
            color: #2b6cb0;
            margin-top: 0;
            margin-bottom: 10px;
        }
        
        .room-info p {
            margin: 5px 0;
            color: #4a5568;
        }
        
        .room-info .price {
            font-size: 18px;
            font-weight: 600;
            color: #2b6cb0;
        }
        
        @media (max-width: 768px) {
            .booking-container {
                padding: 20px;
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
                    <div class="booking-header">Book Room</div>
                    
                    <!-- Room Information -->
                    <div class="room-info">
                        <h3>{{ $room->room_title }}</h3>
                        <p><strong>Type:</strong> {{ $room->room_type }}</p>
                        <p><strong>Number:</strong> {{ $room->room_number }}</p>
                        <p class="price"><strong>Price:</strong> {{ $room->price_per_night }} DA per night</p>
                    </div>
                    
                    <form action="{{ url('add_booking', $room->id) }}" method="post">
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
            
            if(month < 10)
                month = '0' + month.toString();
            if(day < 10)
                day = '0' + day.toString();
            
            var minDate = year + '-' + month + '-' + day;
            
            $('#startDate').attr('min', minDate);
            $('#endDate').attr('min', minDate);
            
            // Set end date to be after start date
            $('#startDate').change(function() {
                var startDate = $(this).val();
                $('#endDate').attr('min', startDate);
            });
        });
    </script>
</body>
</html>