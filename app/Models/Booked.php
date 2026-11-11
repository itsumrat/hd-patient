<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booked extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
    protected $table = 'employee_booked';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    public function employeeName(){
        return $this->hasOne(Patient::class, "id", "patient_id");
    }

    public function patientName(){
        return $this->hasOne(Patient::class, "id", "patient_id");
    }

    public function getEmployee(){
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }

}
