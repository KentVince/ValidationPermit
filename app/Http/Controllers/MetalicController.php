<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class MetalicController extends Controller
{
    //

    public function index(Request $request)
    {



        if(is_null($request))
        {
            dd('null');
        }

        $users = DB::table('aotp')->paginate(10);

        return view('metallic.index',compact('users'));
    }

    public function loadData(Request $request)
    {

        $search = $request->cert_or;
        $cert_orNumber = '';
        $certDate = '';
        try{
            $exploded_cert_or = explode('/', $search);

            $certDate = $exploded_cert_or[1];
            $cert_orNumber = $exploded_cert_or[0];
        }catch(\Throwable $th) {

        }



        $data = DB::table('aotp')
                    ->where('control_no',$request->otp)
                    ->where('permittee_name', $request->permitee)
                    ->where('applicant_name', $request->applicant)
                    ->where('certification_or', $cert_orNumber)
                    ->where('certification_date', $certDate)
                    ->where('receipt_no', $request->receipt)
                    ->first();

        // return \json_encode($data);
        return \json_encode($data);

    }



}
