<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payslip extends Model
{
    use HasFactory;

    protected $fillable = [
        'payroll_id',
        'employee_id',
        'salary_id',
        'gross_salary',
        'meal_allowance',
        'transpo_allowance',
        'deductions',
        'net_salary',
        'issued_date',
        'payment_method'
    ];

    /**
     * Relationships
     */

    // Payslip belongs to an employee
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    // Payslip belongs to a payroll
    public function payroll()
    {
        return $this->belongsTo(Payroll::class);
    }

    // Payslip belongs to a salary record (optional)
    public function salary()
    {
        return $this->belongsTo(Salary::class);
    }

    /**
     * Accessors & Mutators
     */

    // Ensure net_salary is always calculated correctly
    public function setNetSalaryAttribute()
    {
        $this->attributes['net_salary'] =
            ($this->attributes['gross_salary'] ?? 0) +
            ($this->attributes['meal_allowance'] ?? 0) +
            ($this->attributes['transpo_allowance'] ?? 0) -
            ($this->attributes['deductions'] ?? 0);
    }
}
