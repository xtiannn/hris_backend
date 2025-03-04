<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'total_earnings',
        'total_deductions',
        'net_salary',
        'pay_date',
        'status'
    ];

    /**
     * Define relationship with Employee model.
     * A payroll record belongs to an employee.
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
