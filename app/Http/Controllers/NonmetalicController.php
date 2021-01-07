<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class NonmetalicController extends Controller
{
    //

    public function index(Request $request)
    {



        if(is_null($request))
        {
            dd('null');
        }

        $users = DB::table('otpnm_table')->paginate(10);

        return view('nonmetallic.index',compact('users'));
    }

    public function loadData(Request $request)
    {

        $data = DB::table('otpnm_table')
                    ->where('otp_number',$request->otp)
                    ->where('name_permitee', $request->permitee)
                    ->where('name_applicant', $request->applicant)
                    ->where('or4', $request->or1)
                    ->where('or1', $request->or2)
                    ->where('or2', $request->or3)
                    ->first();

        return \json_encode($data);


    }



}
