<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Patient;
use App\Models\Phoneticket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PhoneticketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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

        $asfaullEvent = Event::where('id', $request->event_id)->first();


        if(!empty($asfaullEvent)){
            $exception = !empty($asfaullEvent->exception) ?  $request->get_data.'T'.$asfaullEvent->start_time.','.$asfaullEvent->exception : $request->get_data.'T'.$asfaullEvent->start_time;


            if($asfaullEvent->recurring != null){

                $asfaullEvent->update(['exception' => $exception]);

                $newEvent = $asfaullEvent->replicate();
                $newEvent->color = '#dc3545';
                $newEvent->recurring = null;
                $newEvent->exception = null;
                $newEvent->id = '_'.date('Ym', strtotime(now())) . rand(1000000, 9999999);
                $newEvent->start_date = date('Y-m-d', strtotime($request->get_data));
                $newEvent->end_date = date('Y-m-d', strtotime($request->get_data));

                // 3. Save it back to the database safely
                $newEvent->save();

            }else{

                $asfaullEvent->update(['exception' => $exception, 'color' => '#dc3545']);
            }


        }




        $data['status'] = "Ausfall";
        $data['employee_id'] = $request->getEmployee;
        $data['date'] = date('Y-m-d', strtotime($request->get_data)).' '.$request->start_time;
        $data['start_time'] = $request->start_time;
        $data['patient_id'] = Auth::guard('patient')->user()->id;
        $data['event_id'] = $request->event_id;
        $data['contact'] = Auth::guard('patient')->user()->mobile;
        $data['description'] = "Ausfall am ".date('d.m.Y', strtotime($request->get_data))." ".$request->get_time;
        $data['created_by'] = Auth::guard('patient')->user()->id;
        $data['updated_by'] = Auth::guard('patient')->user()->id;

        Phoneticket::create($data);

         return response()->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Phoneticket $phoneticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Phoneticket $phoneticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Phoneticket $phoneticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Phoneticket $phoneticket)
    {
        //
    }
}
