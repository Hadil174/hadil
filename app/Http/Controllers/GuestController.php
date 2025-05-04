<?php

namespace App\Http\Controllers;

use App\Models\AlternativeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuestController extends Controller
{
    // Show the form for requesting additional services
    public function showRequestForm()
{
    $services = [
        ['name' => 'Food', 'price' => 500],
        ['name' => 'Laundry', 'price' => 300],
        ['name' => 'Spa Access', 'price' => 1000],
    ];

    return view('home.request_service', compact('services'));
}


    // Store the guest's service request
    public function storeRequest(Request $request)
    {
        // Validate the form input
        $request->validate([
            'service_name' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        // Store the request in the AlternativeService table
        AlternativeService::create([
            'guest_id' => Auth::id(),  // Use the guest's ID (assuming they are logged in)
            'service_name' => $request->service_name,
            'notes' => $request->notes,
            'price' => 50.00, // You can adjust the price dynamically if needed
        ]);

        // Redirect back with a success message
        return redirect()->route('guest.services.create')->with('success', 'Your service request has been submitted.');
    }
}
