<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $fillable = [
        'title',            // matches migration
        'department_id',    // foreign key
        'description',      // nullable
        'salary_range_min', // decimal
        'salary_range_max', // decimal
    ];

    // Relationships
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}