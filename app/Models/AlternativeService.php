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

    public function guest()
    {
        return $this->belongsTo(User::class, 'guest_id');
    }
  
    
   // app/Models/AlternativeService.php

public function room()
{
    return $this->belongsTo(Room::class);
}

  
}
