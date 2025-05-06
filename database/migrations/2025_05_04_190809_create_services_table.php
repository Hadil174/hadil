<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('services', function (Blueprint $table) {
        $table->id();  // Auto-incrementing primary key
        $table->string('room_number');  // Store the room number of the guest
        $table->string('guest_name');   // Store the guest's name
        $table->string('service_name'); // Store the service name (e.g., "Extra Towels")
        $table->decimal('price', 8, 2); // Store the price of the service
        $table->text('notes')->nullable(); // Optional field for any additional notes
        $table->timestamps();  // Automatically adds created_at and updated_at timestamps
    });
}

public function down()
{
    Schema::dropIfExists('services');  // Drop the table if the migration is rolled back
}


    /**
     * Reverse the migrations.
     */
  
};
