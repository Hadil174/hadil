<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Booking;
use App\Models\Employee;
use App\Models\AlternativeService;
use App\Notifications\NewServiceRequest;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class ReceptionistController extends Controller
{
     public function list_room(){
            $data = Room::all();
            return view('receptionist.list_room',compact('data'));
        }
        // ReceptionistController.php
  // Process check-in
public function checkin($id)
{
    $booking = Booking::findOrFail($id);
    
    // Update booking status
    $booking->update([
        'status' => 'checked_in',
        'actual_checkin' => now()
    ]);
    
    // Update room status
    $booking->room->update([
        'status' => 'occupied'
    ]);
    
    return redirect()->back()->with('success', 'Guest checked in successfully');
}

// Process check-out
public function checkout($id)
{
    $booking = Booking::findOrFail($id);
    
    // Update booking status
    $booking->update([
        'status' => 'checked_out',
        'actual_checkout' => now()
    ]);
    
    // Update room status to need cleaning
    $booking->room->update([
        'status' => 'housekeeping',
        'clean_status' => 'dirty'
    ]);
    
    return redirect()->back()->with('success', 'Guest checked out successfully');
}

        
        
        
public function list_booking(){
    $data = Booking::with('room')->get(); // ✅ eager load to avoid N+1 problem
    return view('receptionist.list_booking', compact('data'));
}
public function delete_booking($id) {
    $data = Booking::find($id);
    if ($data) {
        $data->delete();
        return redirect()->back()->with('success', 'Booking deleted successfully');
    } else {
        return redirect()->back()->with('error', 'Booking not found');
    }
}
// Show the form
public function manageRoomStatus($id)
{
    $room = Room::with('lastCleanedBy')->findOrFail($id);
    $employees = Employee::all(); // For assigning cleaner
    return view('receptionist.room_status', compact('room', 'employees'));
}

// Handle the update
public function updateRoomStatus(Request $request, $id)
{
    $room = Room::findOrFail($id);

    // Cleaning info
    $room->clean_status = $request->input('clean_status');
    $room->last_cleaned_by = $request->input('last_cleaned_by');
    $room->last_cleaned_at = now();

    // Maintenance info
    $room->needs_maintenance = $request->has('needs_maintenance');
    $room->maintenance_notes = $request->input('maintenance_notes');
    $room->last_maintenance_date = now();

    $room->save();

    return redirect()->back()->with('success', 'Room status updated successfully.');
}

public function todayCheckins()
{
    $today = now()->format('Y-m-d');
    
    // Get bookings where start_date is today AND not checked in
    // OR where check_in date is today (already checked in)
    $checkins = Booking::with(['room'])
        ->where(function($query) use ($today) {
            $query->whereDate('start_date', $today)
                  ->where('is_checked_in', false);
        })
        ->orWhere(function($query) use ($today) {
            $query->whereDate('check_in', $today);
        })
        ->orderBy('start_date')
        ->get();
        
    logger('Today: '.$today.' - Found check-ins: '.$checkins->count());
    
    return view('receptionist.today_checkins', compact('checkins'));
}

public function todayCheckouts()
{
    $today = now()->format('Y-m-d');
    
    $checkouts = Booking::with(['room'])
        ->where(function($query) use ($today) {
            $query->whereDate('end_date', $today)
                  ->where('is_checked_in', true)
                  ->where('is_checked_out', false);
        })
        ->orWhere(function($query) use ($today) {
            $query->whereDate('check_out', $today);
        })
        ->orderBy('end_date')
        ->get();
        
    return view('receptionist.today_checkouts', [
        'checkouts' => $checkouts,
        'today' => now() // Pass Carbon instance for consistent formatting
    ]);
}
public function viewRequestedServices()
{
    $services = AlternativeService::all(); // You can filter this based on your needs
    $guests = User::all(); // Fetch all guests (users)
    return view('receptionist.services', compact('services', 'guests'));
}

// Create a new service request for a guest
// app/Http/Controllers/ReceptionistController.php

public function createNewServiceRequest(Request $request)
{
    $validated = $request->validate([
        'guest_id' => 'required|exists:users,id',
     
        'service_name' => 'required|string',
        'price' => 'required|numeric',
        'notes' => 'nullable|string',
    ]);

    $serviceRequest = AlternativeService::create($validated);


    return back()->with('success', 'Service request submitted!');
}


// In your NewServiceRequest notification class
// public function notification(){
//     $data = Contact::all();
//     return view('receptionist.notification',compact('data'));
// }


public function all_service_requests()
{
    $services = AlternativeService::with(['guest', 'room'])->latest()->get();

    return view('receptionist.notification', compact('services'));
}


}

