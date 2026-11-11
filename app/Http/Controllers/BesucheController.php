<?php

namespace App\Http\Controllers;

use RRule\RRule;
use Carbon\Carbon;
use App\Models\Event;
use App\Models\Phoneticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BesucheController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data['notices'] = DB::table('patient_notice')->first();

        $patientId = Auth::guard('patient')->user()->id;


        $events = Event::with('getEmployee')->whereExists(function ($query) {
            $query->select(DB::raw(1))
                ->from('employees')
                ->whereColumn('employees.id', 'event_calendars.employee_id')
                ->where('employees.status', 1);
        })->where('patient_id', $patientId)->where('recurring', '!=', null)->get();

        $currentDate =  date('Y-m-d', strtotime( Carbon::now()));
        $currentMonth =  date('Y-m-t', strtotime( Carbon::now()->addMonth(1)));

        $singleEvents = Event::with('getEmployee')->whereExists(function ($query) {
            $query->select(DB::raw(1))
                ->from('employees')
                ->whereColumn('employees.id', 'event_calendars.employee_id')
                ->where('employees.status', 1);
        })->where('patient_id', $patientId)
        // ->where('status', 1)->where('color', '#dc3545')
        // ->where('status', 1)
        ->whereBetween('start_date', [$currentDate, $currentMonth])->where('recurring', null)->get();



        $phoneTickets = Phoneticket::where('patient_id', $patientId)->whereBetween('date', [$currentDate.' 00:00:00', $currentMonth.' 23:59:59'])->get();


        $checkCancel['event_id'] = [];
        $checkCancel['date_time'] = [];
        foreach($phoneTickets as $ticket){

            $checkCancel['event_id'][] = $ticket->event_id;
            $checkCancel['date_time'][] = date('Y-m-d_H:i', strtotime($ticket->date));

        }


        $recursiveSlots = [];
        // Recursive Events
        foreach($events as $k => $recursive) {

            $dayName =  date('l', strtotime($recursive->start_date));

            $rrules = new RRule([
                'FREQ' => $recursive->recurring['repeat'],
                'INTERVAL' => $recursive->recurring['interval'],
                'DTSTART' => $recursive->start_date,
                'UNTIL' => isset($recursive->recurring['until']) && strtotime($recursive->recurring['until']) < strtotime($currentMonth)  ? date('Y-m-d', strtotime($recursive->recurring['until'])) : $currentMonth,
                'BYDAY' => isset($recursive->recurring['weekDays']) ? $recursive->recurring['weekDays'] : null
            ]);

            foreach($rrules as $rrule){

                if(( (!isset($recursive->recurring['until']) || (isset($recursive->recurring['until']) && strtotime($rrule->format('Y-m-d')) < strtotime($recursive->recurring['until']))) && (strtotime($rrule->format('Y-m-d')) >= strtotime($currentDate)))){

                    if( $recursive->recurring['weekDays'] != "SU" && (empty($recursive->exception) || !empty($recursive->exception) && !in_array($rrule->format('Y-m-d').'T'.$recursive->start_time, explode(",",$recursive->exception))) ){
                        $recursiveSlots[]  = [
                            "event_id" => $recursive->id,
                            "title" => $recursive->name,
                            "_time" => $recursive->start_time.'-'.$recursive->end_time,
                            "description" => $recursive->description,
                            "resource" => $recursive->resource,
                            "color" => $recursive->color,
                            "startDate" => $rrule->format('Y-m-d'),
                            "start" => $recursive->start_time,
                            "end" => $recursive->end_time,
                            "status" => (in_array($recursive->id, $checkCancel['event_id']) && in_array($rrule->format('Y-m-d').'_'.$recursive->start_time, $checkCancel['date_time'])) ? 1 : 0,
                            "employee" => (!empty($recursive->getEmployee)) ? $recursive->getEmployee->first_name.' - '.$recursive->getEmployee->last_name : "",
                            "employee_id" => (!empty($recursive->getEmployee)) ? $recursive->getEmployee->id : "",
                        ];

                    }

                }


            }


        }


        // Single Events

        foreach($singleEvents as $k => $single){
            $recursiveSlots[]  = [
                "event_id" => $single->id,
                "title" => $single->name,
                "_time" => $single->start_time.'-'.$single->end_time,
                "description" => $single->description,
                "resource" => $single->resource,
                "color" => $single->color,
                "startDate" => date('Y-m-d', strtotime($single->start_date)),
                "start" => $single->start_time,
                "end" => $single->end_time,
                "status" => (in_array($single->id, $checkCancel['event_id'])) ? 1 : 0,
                "employee" => $single->getEmployee->first_name.' '.$single->getEmployee->last_name,
                "employee_id" => (!empty($single->getEmployee)) ? $single->getEmployee->id : "",
            ];
        }


        $data['recursiveSlots'] = $recursiveSlots;

        $data['tickets'] = Phoneticket::with('getPatient')->where('patient_id', $patientId)->get();


        return view('besuche.index', $data)->with('title', 'Besuche');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
