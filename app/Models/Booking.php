<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Booking extends Model
{
    use HasFactory;

    const STATUSES = [
        'pending' => 'Pending',
        'confirmed' => 'Confirmed',
        'checked_in' => 'Checked In',
        'checked_out' => 'Checked Out',
        'cancelled' => 'Cancelled',
        'temporary' => 'Temporary' // For PayPal processing
    ];

    const PAYMENT_STATUSES = [
        'pending' => 'Pending',
        'completed' => 'Completed',
        'failed' => 'Failed',
        'refunded' => 'Refunded'
    ];

    protected $fillable = [
        'room_id',
        'user_id',
        'name',
        'email',
        'phone',
        'start_date',
        'end_date',
        'nights',
        'amount',
        'currency',
        'payment_status',
        'payment_method',
        'transaction_id',
        'payment_details',
        'status',
        'check_in',       // fixed field name
        'check_out',      // fixed field name
        'is_checked_in',
        'is_checked_out'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'check_in' => 'datetime',     // fixed
        'check_out' => 'datetime',    // fixed
        'payment_details' => 'array',
        'amount' => 'decimal:2',
        'is_checked_in' => 'boolean',
        'is_checked_out' => 'boolean'
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function scopeTodayCheckins($query)
    {
        return $query->whereDate('start_date', Carbon::today())
                     ->where('status', 'confirmed');
    }

    public function scopeTodayCheckouts($query)
    {
        return $query->whereDate('end_date', Carbon::today())
                     ->where('status', 'checked_in');
    }

    // Helper method to calculate total nights
    public function calculateNights()
    {
        return Carbon::parse($this->start_date)->diffInDays(Carbon::parse($this->end_date));
    }

    // Mark payment as completed
    public function markPaymentCompleted($transactionId, $paymentDetails)
    {
        $this->update([
            'payment_status' => 'completed',
            'transaction_id' => $transactionId,
            'payment_details' => $paymentDetails,
            'status' => 'confirmed',
            'nights' => $this->calculateNights()
        ]);
    }
}
