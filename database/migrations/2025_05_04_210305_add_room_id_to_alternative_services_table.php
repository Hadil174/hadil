<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('alternative_services', function (Blueprint $table) {
            $table->foreignId('room_id')->constrained()->onDelete('cascade');
        });
    }
    
    public function down(): void
    {
        Schema::table('alternative_services', function (Blueprint $table) {
            $table->dropForeign(['room_id']);
            $table->dropColumn('room_id');
        });
    }
    
};
