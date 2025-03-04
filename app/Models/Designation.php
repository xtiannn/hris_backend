<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    use HasFactory;

    protected $fillable = [
        'designation',  // Ensure this matches your DB column name!
        'department_id',
    ];

    // Relationship: A designation belongs to a department
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    // Relationship: A designation can have many employees
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
