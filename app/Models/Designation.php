<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    use HasFactory;
    protected $fillable = [
        'designation',
        'department_id',
    ];

    public function employee()
    {
        return $this->hasMany(Employee::class);
    }
}
