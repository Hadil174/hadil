<?php

namespace App\Http\Controllers;


use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;

class BookingController extends Controller
{


 
    public function add_booking(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'startDate' => 'required|date',
            'endDate'   => 'required|date|after:startDate',
        ]);
    
        // Convert dates to correct format
        $startDate = date('Y-m-d', strtotime($request->startDate));
        $endDate   = date('Y-m-d', strtotime($request->endDate));
    
        // Check if the room is already booked
        $isBooked = Booking::where('room_id', $id)
            ->where('start_date', '<=', $endDate)
            ->where('end_date', '>=', $startDate)
            ->exists();
    
        // If room is already booked, show an error message
        if ($isBooked) {
            return redirect()->back()->with('error', 'Room is already booked. Please try different dates.');
        }
    
        // Create a new booking
        $data = new Booking;
        $data->room_id   = $id;
        $data->name      = $request->name;
        $data->email     = $request->email;
        $data->phone     = $request->phone;
        $data->start_date = $startDate;
        $data->end_date  = $endDate;
    
        try {
            $data->save();  // Save the booking data
            return redirect()->back()->with('success', 'Room booked successfully!');
        } catch (\Exception $e) {
            // If there's an error, show an error message
            return redirect()->back()->with('error', 'Failed to book room. Please try different dates.');
        }
    }
    








    // public function createReservation(Request $request)
    // {
    //     // Validate the request data
    //     $request->validate([
    //         'room_id' => 'required|exists:rooms,id',
    //         'guest_name' => 'required|string|max:255',
    //         'guest_email' => 'nullable|email',
    //         'check_in_date' => 'required|date|after_or_equal:today',
    //         'check_out_date' => 'required|date|after:check_in_date',
    //         'status' => 'required|string|in:pending,confirmed,cancelled',
    //         'amenities' => 'nullable|json',
    //     ]);

    //     // Create reservation
    //     $reservation = Reservation::create([
    //         'room_id' => $request->room_id,
    //         'guest_name' => $request->guest_name,
    //         'guest_email' => $request->guest_email,
    //         'check_in_date' => $request->check_in_date,
    //         'check_out_date' => $request->check_out_date,
    //         'status' => $request->status,
    //         'amenities' => $request->amenities,
    //     ]);

    //     // Update the room status to 'occupied' when reservation is confirmed
    //     if ($request->status === 'confirmed') {
    //         Room::where('id', $request->room_id)->update(['status' => 'occupied']);
    //     }

    //     return response()->json([
    //         'status' => 'success',
    //         'message' => 'Reservation created successfully',
    //         'data' => $reservation
    //     ], 201);
    // }
}
