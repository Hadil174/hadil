<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'position_id',
        'hire_date',
        'address',
        'employment_status',
        'role',
        'department',
        'profile_picture',
    ];

    // Relationships
    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class); // If you have department_id
    }
    public function salaries()
{
    return $this->hasMany(Salary::class);
}
// app/Models/Employee.php

public function cleanedRooms()
{
    return $this->hasMany(Room::class, 'last_cleaned_by');
}
public function attendance()
{
    return $this->hasMany(Attendance::class);
}
public function user()
{
    return $this->belongsTo(User::class);
}

}