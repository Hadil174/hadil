@php
    use Illuminate\Support\Str;
@endphp

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
</style>

<div class="our_room">
   <div class="container">
       <div class="row">
           <div class="col-md-12">
               <div class="titlepage">
                   <h2>Our Room</h2>
                   <p>Lorem Ipsum available, but the majority have suffered</p>
               </div>
           </div>
       </div>

       <div class="row">
           @foreach($room as $rooms)
           <div class="col-md-4 col-sm-6">
               <div id="serv_hover" class="room">
                   <div class="room_img">
                       <figure>
                           <img src="room/{{ $rooms->images }}" alt="{{ $rooms->room_title }}" />
                       </figure>
                   </div>
                   <div class="bed_room">
                       <h3>{{ $rooms->room_title }}</h3>
                       <p>{!! Str::limit($rooms->description, 100) !!}</p>
                       <a class="btn" href="{{url('room_details',$rooms->id)}}">Room Details</a>
                   </div>
               </div>
           </div>
           @endforeach
       </div>
   </div>
</div>
