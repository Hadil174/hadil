<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Employee;

class HousekeepingController extends Controller
{
    public function markAsClean(Request $request, Room $room)
    {
        $request->validate([
            'clean_status' => 'required|in:clean,dirty,in_progress',
            'last_cleaned_by' => 'required|exists:employees,id', 
        ]);
    
        $room->update([
            'clean_status' => $request->clean_status,
            'last_cleaned_by' => $request->last_cleaned_by,
        ]);
    
        return response()->json([
            'status' => 'success',
            'message' => 'Room cleaning status updated successfully',
            'data' => [
                'room_number' => $room->room_number, // Showing room number
                'clean_status' => $room->clean_status,
                'last_cleaned_by' => $room->last_cleaned_by,
            ]
        ]);
    }
}    