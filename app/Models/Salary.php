<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'basic_salary',
        'basic_period',
        'start_date',
        'end_date',
        'status'
    ];

    /**
     * Define the relationship between Salary and Employee.
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
