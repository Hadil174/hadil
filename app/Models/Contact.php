<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Contact extends Model

{
    use HasFactory;
    use Notifiable;
    protected $fillable = [
        'name',
        'email',
        'phone',
        'message',
    ];
     public function routeNotificationForMail($notification)
    {
        // Assuming you have an 'email' column in your contacts table
        return $this->email;
        
        // If your email column has a different name, use that instead:
        // return $this->contact_email; // Example if column is named 'contact_email'
    }
}
