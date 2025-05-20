@php
    use Illuminate\Support\Str;
@endphp

<style>
    .our_room {
        background-color: #fefcf6;
        padding: 60px 0;
    }

    .titlepage {
        position: relative;
        margin-bottom: 30px;
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

    .back-home-btn {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        background-color: #6e5d32;
        color: white;
        padding: 8px 20px;
        border-radius: 4px;
        font-weight: 500;
        text-decoration: none;
        font-size: 14px;
        transition: all 0.3s ease;
        border: 1px solid #5a4a29;
    }

    .back-home-btn:hover {
        background-color: #5a4a29;
        transform: translateY(-50%) translateY(-1px);
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    }

    .row.custom-room-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }

    .room-card {
        flex: 0 0 calc(33.333% - 20px);
        max-width: calc(33.333% - 20px);
        background-color: #fff;
        border: 1px solid #e0dac5;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    @media (max-width: 992px) {
        .room-card {
            flex: 0 0 calc(50% - 20px);
            max-width: calc(50% - 20px);
        }
    }

    @media (max-width: 768px) {
        .back-home-btn {
            position: relative;
            left: auto;
            top: auto;
            transform: none;
            margin-bottom: 15px;
            display: inline-block;
        }
        
        .titlepage {
            text-align: center;
        }
    }

    @media (max-width: 576px) {
        .room-card {
            flex: 0 0 100%;
            max-width: 100%;
        }
    }

    .room-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }

    .room_img {
        height: 220px;
        overflow: hidden;
    }

    .room_img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .room-card:hover .room_img img {
        transform: scale(1.05);
    }

    .bed_room {
        padding: 20px;
        display: flex;
        flex-direction: column;
        height: 100%;
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
        flex-grow: 1;
    }

    .bed_room .btn {
        background-color: #6e5d32;
        color: white;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 500;
        text-transform: uppercase;
        font-size: 14px;
        transition: all 0.3s ease;
        text-decoration: none;
        width: fit-content;
        align-self: start;
        border: none;
        cursor: pointer;
    }

    .bed_room .btn:hover {
        background-color: #5a4a29;
        transform: translateY(-2px);
    }
</style>

<div class="our_room">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="titlepage">
                    <a href="{{ url('/') }}" class="back-home-btn">← Back to Home</a>
                    <h2>Our Room</h2>
                    <p>Lorem Ipsum available, but the majority have suffered</p>
                </div>
            </div>
        </div>

        <div class="row custom-room-grid">
            @isset($rooms)
                @foreach($rooms as $room)
                    <div class="room-card">
                        <div class="room_img">
                            <figure>
                                <img src="{{ asset('room/' . $room->images) }}" alt="{{ $room->room_title }}" />
                            </figure>
                        </div>
                        <div class="bed_room">
                            <h3>{{ $room->room_title }}</h3>
                            <p>{!! Str::limit($room->description, 100) !!}</p>
                            <a class="btn" href="{{ url('room_details', $room->id) }}">Room Details</a>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12">
                    <div class="alert alert-warning">No rooms data found!</div>
                </div>
            @endisset
        </div>
    </div>
</div>