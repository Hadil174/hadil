@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Booking Saved</h2>
        <p>{{ $error }}</p>

        <h4>Booking Details:</h4>
        <ul>
            <li><strong>Name:</strong> {{ $booking->name }}</li>
            <li><strong>Room ID:</strong> {{ $booking->room_id }}</li>
            <li><strong>Start Date:</strong> {{ $booking->start_date }}</li>
            <li><strong>End Date:</strong> {{ $booking->end_date }}</li>
            <li><strong>Amount:</strong> {{ $booking->amount }} {{ $booking->currency }}</li>
            <li><strong>Payment Status:</strong> {{ $booking->payment_status }}</li>
        </ul>
    </div>
@endsection
