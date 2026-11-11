<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Phoneticket extends Model
{
    protected $table = 'tickets';
    protected $guarded = [];

    public function getPatient(){
        return $this->belongsTo(Patient::class, 'patient_id', 'id');
    }
}
