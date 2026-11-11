<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $primaryKey = 'calendar_id';
    protected $table = 'event_calendars';
    protected $guarded = [];


    protected $casts = [
        'recurring' => 'json',
        'all_day' => 'boolean',
        'event_id' => 'string',
    ];


    public function getEmployee(){
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }

}
