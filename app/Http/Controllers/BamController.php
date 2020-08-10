<?php

namespace App\Http\Controllers;

use App\MedcineTravail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        if (Auth::user()->is_admin) {
            $canevas = DB::table('declaration_accident_materiels')
                        ->select(DB::raw('YEAR(created_at) year'))
                        ->groupBy('year')
                        ->get();

        }else{
            $canevas =  DB::table('declaration_accident_materiels')
                        ->select(DB::raw('YEAR(created_at) year'))
                        ->where('unite', Auth::user()->unite)
                        ->groupBy('year')
                        ->get();
        }
         return view('HSE.BAM.index')->with([
            'canevas' => $canevas,
         ]);
    }
}
