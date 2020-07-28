<?php

namespace App\Http\Controllers;

use App\MedcineTravail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MtController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        if (Auth::user()->is_admin) {
            $canevas = MedcineTravail::all();
        }else{
            $canevas = MedcineTravail::where('unite',Auth::user()->unite)->get();
        }
         return view('HSE.MT.index')->with([
             'canevas' => $canevas,
         ]);
    }
}
