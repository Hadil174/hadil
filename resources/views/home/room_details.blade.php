<!DOCTYPE html>
<html lang="en">
<head>
    <base href="/public">
    @include('home.css')
    <style>
        .our_room {
            background-color: #fefcf6;
            padding: 60px 0;
        }

        .titlepage h2 {
            font-family: 'Montserrat', sans-serif;
            font-size: 36px;
            font-weight: 700;
            color: #6e5d32;
            margin-bottom: 10px;
            text-align: center;
        }

        .titlepage p {
            color: #9c8b62;
            font-size: 16px;
            text-align: center;
            max-width: 600px;
            margin: 0 auto 30px auto;
        }

        .room {
            background-color: #fff;
            border: 1px solid #e0dac5;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
            overflow: hidden;
            margin-bottom: 30px;
        }

        .room:hover {
            transform: translateY(-5px);
        }

        .room_img img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            border-bottom: 1px solid #e0dac5;
        }

        .bed_room {
            padding: 20px;
        }

        .bed_room h3 {
            color: #6e5d32;
            font-size: 20px;
            margin-bottom: 10px;
            font-weight: 600;
            font-family: 'Montserrat', sans-serif;
        }

        .bed_room p {
            font-size: 14px;
            color: #5a4a29;
            margin-bottom: 15px;
        }

        .bed_room .btn {
            background-color: #6e5d32;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 500;
            text-transform: uppercase;
            font-size: 14px;
            transition: background-color 0.3s ease;
            text-decoration: none;
        }

        .bed_room .btn:hover {
            background-color: #5a4a29;
        }
     
    .booking-box {
        background-color: #fffaf0;
        border: 1px solid #e0dac5;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: 500;
        color: #6e5d32;
        font-family: 'Montserrat', sans-serif;
    }

    .form-group input[type="text"],
    .form-group input[type="email"],
    .form-group input[type="number"],
    .form-group input[type="date"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc9b5;
        border-radius: 6px;
        font-size: 14px;
        font-family: 'Montserrat', sans-serif;
    }

    .btn-book {
        background-color: #6e5d32;
        color: white;
        padding: 12px 25px;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        font-size: 14px;
        text-transform: uppercase;
        width: 100%;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-book:hover {
        background-color: #5a4a29;
    }

    </style>
</head>
<body class="main-layout">
    <div class="loader_bg">
        <div class="loader"><img src="images/loading.gif" alt="#"/></div>
    </div>

    <!-- Include header -->
    @include('home.header')

    <div class="our_room">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="titlepage">
                        <h2>Room Details</h2>
                      
                    </div>
                </div>
            </div>

            <!-- Display single room -->
            <div class="row">
                <div class="col-md-6">
                    <div id="serv_hover" class="room">
                        <div class="room_img">
                            <!-- Display the room image -->
                            <img src="room/{{ $room->images }}" alt="{{ $room->room_title }}">
                        </div>
                        <div class="bed_room">
                            <!-- Room Title -->
                            <h4 style="padding: 12px">{{ $room->room_title }}</h4>

                            <!-- Room Description -->
                            <p style="padding: 12px">{{ $room->description }}</p>

                          <h4 style="padding: 12px">Room type : {{ $room->room_type}}</h4>
                          <h3 style="padding: 12px">Price : {{ $room->price_per_night}} Da</h3>
                          
                          
                        </div>
                    </div>
                </div>

                <div class="col-md-4" style="margin-left: 100px;">
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                  
                @endif
                @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
                    @if ($errors->any())
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                
                  <form action="{{url('add_booking',$room->id)}}" method="post">
                    @csrf

                    <div class="booking-box">
                        <h1 style="color: burlywood"> Book Room</h1>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name">
                        </div>
                
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email">
                        </div>
                
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="number" name="phone" id="phone">
                        </div>
                
                        <div class="form-group">
                            <label for="startDate">Start Date</label>
                            <input type="date" name="startDate" id="startDate">
                        </div>
                
                        <div class="form-group">
                            <label for="endDate">End Date</label>
                            <input type="date" name="endDate" id="endDate">
                        </div>
                
                        <div class="form-group">
                            <input type="submit" class="btn-book" value="Book Now">
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Include footer -->
    @include('home.footer')
    <script type="text/javascript">
    $(function() {
    var dtToday = new Date();

    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();

    if (month < 10)
        month = '0' + month.toString();
    if (day < 10)
        day = '0' + day.toString();

    var maxDate = year + '-' + month + '-' + day;
    $('#startDate').attr('min', maxDate);
    $('#endDate').attr('min', maxDate);
});
    </script>
</body>
</html>
