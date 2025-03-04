<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'status',
        'date',
        'time_in',
        'time_out'
    ];

    /**
     * Define relationship with Employee model.
     * Each attendance record belongs to one employee.
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
