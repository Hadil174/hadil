<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('room_number')->unique();
            $table->string('room_title');
            $table->string('room_type');
            $table->text('description')->nullable();
            $table->string('images')->nullable(); // Fixed typo from 'iamges' to 'images'
            $table->integer('capacity')->nullable()->change();
            $table->decimal('price_per_night', 10, 2);  // 10 digits, 2 decimal places
          
            $table->json('amenities')->nullable();  // For storing array data
            $table->timestamps();
            
    // Status fields
         $table->enum('status', ['available', 'occupied', 'maintenance', 'housekeeping', 'out_of_order']);
         $table->enum('clean_status', ['clean', 'dirty', 'in_progress']);

// Housekeeping
        $table->timestamp('last_cleaned_at')->nullable();
        $table->foreignId('last_cleaned_by')->nullable()->constrained('employees');

// Maintenance
        $table->boolean('needs_maintenance')->default(false);
        $table->text('maintenance_notes')->nullable();
        $table->timestamp('last_maintenance_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};