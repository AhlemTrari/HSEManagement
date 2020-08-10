<?php

namespace App\Http\Controllers;

use App\Employe;
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
        $employes = Employe::where('unite',Auth::user()->unite)->get();
         return view('HSE.MT.index')->with([
             'canevas' => $canevas,
             'employes' => $employes,
         ]);
    }
    public function store(Request $request)
    {
        $year =  now()->year;
        $year = substr( $year,-2);
        
        $last = MedcineTravail::all()->last();
        
        $canevas = new MedcineTravail();

        if ($last && $last->created_at->year == now()->year) {
            $n = $last->num;
            $num = substr( $n,0,3);
            $num +=1;
            $num = str_pad($num, 3, '0', STR_PAD_LEFT);

        }else{
            $num = "001";
        }
        
        $canevas->num = $num."/".$year;
        $canevas->unite = Auth::user()->unite;
        $canevas->date = $request->input('date');
        $canevas->employe_id = $request->input('employe_id');
        $canevas->affectation = $request->input('affectation');
        $canevas->visite_periodique = $request->input('visite_periodique');
        $canevas->radiographie = $request->input('radiographie');
        $canevas->examen_bio = $request->input('examen_bio');
        $canevas->observation = $request->input('observation');

        $canevas->save();
        return redirect('/MedcineDeTravail');
    }
}
