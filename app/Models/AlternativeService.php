<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class AlternativeService extends Model
{
    use HasFactory;

    protected $fillable = [
        'guest_id', 
        'service_name', 
        'price', 
        'notes',
    ];

    // Relationship with User model (for guests)
    public function user()
    {
        return $this->belongsTo(User::class, 'guest_id');
    }
  
}
