<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function advance_salary()
    {
        return $this->hasMany(\App\Models\AdvanceSalary::class);
    }

    public function pay_salary()
    {
        return $this->hasMany(\App\Models\PaySalary::class);
    }

    public function attendances()
    {
        return $this->hasMany(\App\Models\Attendance::class);
    }
}
