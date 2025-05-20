<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use Carbon\Carbon;
use App\Models\Employee;
use App\Models\Attendance;



class ServiceManagerController extends Controller
{
    public function viewRoomStatusWithCleaningStaff()
    {
        $rooms = Room::with('lastCleanedBy')->get();

        return view('service_manager.status', compact('rooms'));
    }
    public function checkIn(Request $request)
    {
        $employee_id = $request->user()->employee->id; // Adjust if needed
        $today = Carbon::today()->toDateString();

        $attendance = Attendance::firstOrNew([
            'employee_id' => $employee_id,
            'date' => $today,
        ]);

        if ($attendance->check_in) {
            return back()->with('error', 'You have already checked in today.');
        }

        $attendance->check_in = Carbon::now()->toTimeString();
        $attendance->save();

        return back()->with('success', 'Check-in successful.');
    }

    public function checkOut(Request $request)
    {
        $employee_id = $request->user()->employee->id;
        $today = Carbon::today()->toDateString();

        $attendance = Attendance::where('employee_id', $employee_id)
                                ->where('date', $today)
                                ->first();

        if (!$attendance || !$attendance->check_in) {
            return back()->with('error', 'You have not checked in today.');
        }

        if ($attendance->check_out) {
            return back()->with('error', 'You have already checked out today.');
        }

        $attendance->check_out = Carbon::now()->toTimeString();
        $attendance->save();

        return back()->with('success', 'Check-out successful.');
    }
    
public function attendanceDashboard()
{
    $today = Carbon::today()->toDateString();

    // Get all employees and their attendance for today (left join)
    $employees = Employee::with(['attendance' => function ($query) use ($today) {
        $query->where('date', $today);
    }])->get();

    return view('service_manager.attendance_dashboard', compact('employees', 'today'));
}
}
