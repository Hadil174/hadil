<?php

namespace App\Http\Controllers;


use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;
use App\Models\AlternativeService;

use Carbon\Carbon;

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
    
    public function processBooking(Request $request, Room $room)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'startDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:startDate',
        ]);
    
        // Save booking data to session
        session(['pending_booking' => [
            'room_id' => $room->id,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'start_date' => $validated['startDate'],
            'end_date' => $validated['endDate'],
        ]]);
    
        return redirect()->route('select.payment'); // Go to payment method page
    }
  

    public function payOnSite(Request $request)
    {
        // Calculate nights between start_date and end_date
        $start = Carbon::parse($request->start_date);
        $end = Carbon::parse($request->end_date);
        $nights = $start->diffInDays($end);
    
        // Create booking in database
        $booking = Booking::create([
            'room_id' => $request->room_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'nights' => $nights > 0 ? $nights : 1,  // At least 1 night
            'status' => 'pending',
            'is_checked_in' => false,
            'is_checked_out' => false
        ]);
    
        $room = Room::findOrFail($request->room_id);
        $additionalServicePrice = AlternativeService::where('guest_id', $booking->guest_id)->sum('price');

     
        return view('receptionist.facture', compact('booking', 'room'));
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
