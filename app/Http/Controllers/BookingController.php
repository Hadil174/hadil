<?php

namespace App\Http\Controllers;


use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;

class BookingController extends Controller
{


 
    public function add_booking(Request $request, $id)
    {
        $request->validate([
            'startDate' => 'required|date',
            'endDate'   => 'required|date|after:startDate',
            'name'      => 'required|string',
            'email'     => 'required|email',
            'phone'     => 'required',
        ]);
    
        $startDate = date('Y-m-d', strtotime($request->startDate));
        $endDate   = date('Y-m-d', strtotime($request->endDate));
    
        $isBooked = Booking::where('room_id', $id)
            ->where('start_date', '<=', $endDate)
            ->where('end_date', '>=', $startDate)
            ->exists();
    
        if ($isBooked) {
            return redirect()->back()->with('error', 'Room is already booked. Please try different dates.');
        }
    
        // Store the booking info temporarily in session
        session([
            'pending_booking' => [
                'room_id'    => $id,
                'name'       => $request->name,
                'email'      => $request->email,
                'phone'      => $request->phone,
                'start_date' => $startDate,
                'end_date'   => $endDate,
            ]
        ]);
    
        $room = Room::findOrFail($id);
    
        return view('home.payment', compact('room', 'startDate', 'endDate'));
    }
    
    
    public function showForm($id)
    {
        $room = Room::findOrFail($id);
        return view('receptionist.book_room', compact('room'));
    }
    public function book_room($id)
    {
        // Fetch the specific room by its ID
        $room = Room::findOrFail($id); 
    
        // Return the booking form view with the room data
        return view('receptionist.book_room', compact('room'));
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
