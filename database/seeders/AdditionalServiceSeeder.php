<?php

// database/seeders/AdditionalServiceSeeder.php

// database/seeders/AlternativeServiceSeeder.php

namespace Database\Seeders;

use App\Models\AlternativeService;
use App\Models\User; // Import User model
use Illuminate\Database\Seeder;

class AlternativeServiceSeeder extends Seeder
{
    public function run()
    {
       
        $guest = User::first(); // Get the first user as the guest (you can customize this logic as needed)

        
        AlternativeService::create([
            'guest_id' => $guest->id, // Assign guest ID (you can change this logic)
            'service_name' => 'Spa',
            'price' => 50.00,
            'notes' => 'A relaxing full-body spa treatment.',
        ]);

        AlternativeService::create([
            'guest_id' => $guest->id, // Assign guest ID (you can change this logic)
            'service_name' => 'Room Service',
            'price' => 20.00,
            'notes' => 'Order food and drinks to your room.',
        ]);

        AlternativeService::create([
            'guest_id' => $guest->id, // Assign guest ID (you can change this logic)
            'service_name' => 'Airport Transfer',
            'price' => 30.00,
            'notes' => 'Convenient transportation from the airport.',
        ]);

        AlternativeService::create([
            'guest_id' => $guest->id, // Assign guest ID (you can change this logic)
            'service_name' => 'Laundry Service',
            'price' => 10.00,
            'notes' => 'Get your clothes cleaned during your stay.',
        ]);
    }
}
