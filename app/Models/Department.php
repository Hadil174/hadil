<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];

    // Relationships
    public function positions()
    {
        return $this->hasMany(Position::class);
    }

    public function employees()
    {
        // If employees are linked via positions
        return $this->hasManyThrough(Employee::class, Position::class);
    }
}
