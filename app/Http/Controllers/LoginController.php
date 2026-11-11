<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login(Request $request)
    {



        $patient = Patient::where(function($q) use($request){
            // $q->where('client_no', $request->username);
            // $q->orWhere('email', $request->username);
        })
        ->where('client_no', '=', $request->username)
        ->where('plz', $request->password)
        ->where('patient_archive_active', 1)
        ->first();


        if (empty($patient)) {
            return back()->with('status', 'not match');
        }

        Auth::guard('patient')->loginUsingId($patient->id);


        return redirect('/besuche');

    }


    /**
     * Display a listing of the resource.
     */
    public function logout(Request $request)
    {


        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();


        return redirect('/login');

    }



    /**
     * Display a listing of the resource.
     */
    public function profile(Request $request)
    {

        $data['profile'] = Auth::guard('patient')->user();
        return view('dashboard.profile', $data);
    }




}
