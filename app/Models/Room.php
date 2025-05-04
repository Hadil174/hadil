<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'room_number',
        'room_title',
        'room_type',
        'description',
        'images',
        'capacity',
        'price_per_night',
        'status',
        'clean_status',
        'amenities',
        'last_cleaned_at',
        'last_cleaned_by',
        'needs_maintenance',
        'maintenance_notes',
        'last_maintenance_date',
    ];
    protected $appends = ['image_url'];

public function getImageUrlAttribute()
{
    return $this->images ? asset('storage/' . $this->images) : null;
}


    protected $casts = [
        'amenities' => 'array',
        'status' => 'string',
        'clean_status' => 'string',
        'price_per_night' => 'decimal:2',
        'last_cleaned_at' => 'datetime',
        'last_maintenance_date' => 'datetime',
        'needs_maintenance' => 'boolean',
    ];
    public function bookings()
    {
        return $this->hasMany(\App\Models\Booking::class);
    }
    // app/Models/Room.php

public function lastCleanedBy()
{
    return $this->belongsTo(Employee::class, 'last_cleaned_by');
}

}
