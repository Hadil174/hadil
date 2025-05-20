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
    
        $room = Room::findOrFail($id);
        $nights = \Carbon\Carbon::parse($startDate)->diffInDays(\Carbon\Carbon::parse($endDate));
        $nights = max(1, $nights);
        $totalAmount = $room->price_per_night * $nights;
    
        session([
            'pending_booking' => [
                'room_id'    => $id,
                'name'       => $request->name,
                'email'      => $request->email,
                'phone'      => $request->phone,
                'start_date' => $startDate,
                'end_date'   => $endDate,
                'nights'     => $nights,
                'amount'     => $totalAmount,
            ]
        ]);
    
        return view('home.payment', compact('room', 'startDate', 'endDate', 'totalAmount'));
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
    
        $startDate = date('Y-m-d', strtotime($validated['startDate']));
        $endDate   = date('Y-m-d', strtotime($validated['endDate']));
    
        // Check if room is already booked for selected dates
        $isBooked = Booking::where('room_id', $room->id)
            ->where('start_date', '<=', $endDate)
            ->where('end_date', '>=', $startDate)
            ->exists();
    
        if ($isBooked) {
            return redirect()->back()->with('error', 'This room is already booked for the selected dates. Please choose different dates.');
        }
    
        // Save booking data to session if available
        session(['pending_booking' => [
            'room_id'    => $room->id,
            'name'       => $validated['name'],
            'email'      => $validated['email'],
            'phone'      => $validated['phone'],
            'start_date' => $startDate,
            'end_date'   => $endDate,
        ]]);
    
        return redirect()->route('select.payment'); // Proceed to payment selection
    }
    

   
    
    public function payOnSite(Request $request)
    {
        $validated = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);
    
        $start = Carbon::parse($request->start_date);
        $end = Carbon::parse($request->end_date);
        $nights = $start->diffInDays($end);
        $nights = $nights > 0 ? $nights : 1;
    
        $room = Room::findOrFail($request->room_id);
        $roomAmount = $room->price_per_night * $nights;
    
        // First create the booking (without services)
        $booking = Booking::create([
            'room_id' => $room->id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'nights' => $nights,
            'amount' => $roomAmount, // Temp value; update below after getting services
            'payment_status' => 'completed',
            'payment_method' => 'manual_fallback',
            'status' => 'confirmed',
            'is_checked_in' => false,
            'is_checked_out' => false,
        ]);
    
        // Get additional service cost linked to this guest/booking
        $additionalServicePrice = AlternativeService::where('guest_id', $booking->id)->sum('price');
    
        // Update booking with full amount
        $booking->amount = $roomAmount + $additionalServicePrice;
        $booking->save();
    
        return view('receptionist.facture', [
            'booking' => $booking,
            'room' => $room,
            'additionalServicePrice' => $additionalServicePrice,
        ]);
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
