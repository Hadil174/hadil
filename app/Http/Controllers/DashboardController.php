<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\Models\Room;
// class DashboardController extends Controller
// {
//     public function index()
// {
//     return view('admin.body', [
//         'totalRooms' => Room::count(),
//         'availableRooms' => Room::where('status', 'available')->count(),
//         'checkedIn' => Booking::where('is_checked_in', true)->count(),
//         'totalRevenue' => Booking::sum('price'),
//         'recentBookings' => Booking::latest()->take(5)->get(),
//     ]);
// }

// }
