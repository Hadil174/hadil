<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    protected $fillable = ['employee_id', 'amount', 'payment_date', 'payment_method', 'notes'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
