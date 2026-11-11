<?php

namespace App\Http\Controllers;

use App\Models\Booked;
use RRule\RRule;
use Carbon\Carbon;
use App\Models\Event;
use App\Models\Patient;
use App\Models\Phoneticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ArchivController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request){

        $startDate = $request->selected_date ? Carbon::parse($request->selected_date) : Carbon::now();

        $start = $startDate->copy()->startOfMonth();
        $end   = $startDate->copy()->endOfMonth();
        $data['startDate'] = $startDate;

        $data['books'] = Booked::with('getEmployee:id,first_name,last_name')
        ->whereBetween('book_date', [$start, $end])
        ->where('patient_id', Auth::user()->id)->get();

        return view('booked.index', $data);

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function agree(Request $request){

        $data['information'] = "Der Kunde die AGB´s im Kundenportal bestätigt";
        $data['patient_id'] = Auth::user()->id;
        $data['added_by'] = Auth::user()->id;
        $data['user_name'] = Auth::user()->first_name.' '.Auth::user()->last_name;
        $data['created_at'] = now();
        $data['updated_at'] = now();

        DB::table('patientinfomations')->insert($data);
        Patient::where('id', Auth::user()->id)->update(['popup' => 0]);

        return redirect()->back();

    }
}
