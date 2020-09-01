<?php

namespace App\Http\Controllers;

use App\DeclarationAccidentMateriel;
use App\Employe;
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
            $declarations = DB::table('declaration_accident_materiels')
                        ->select(DB::raw('YEAR(date) as year'))
                        ->groupBy('year')
                        ->get();

        }else{
            $declarations =  DB::table('declaration_accident_materiels')
                        ->select(DB::raw('YEAR(date) as year'))
                        ->where('unite', Auth::user()->unite)
                        ->groupBy('year')
                        ->get();
        }
         return view('HSE.BAM.index')->with([
            'declarations' => $declarations,
         ]);
    }
    
    public function detail($year)
    {
        if (Auth::user()->is_admin) {
            $declarations = DeclarationAccidentMateriel::select('unite',DB::raw('YEAR(date) as year'),DB::raw('MONTH(date) as mois'))
                                    ->where(DB::raw('YEAR(date)'),$year)
                                    ->groupBy('mois')->get();
            $declarationsT = DeclarationAccidentMateriel::select('trimestre','unite',DB::raw('YEAR(date) as year'))
                                    ->where(DB::raw('YEAR(date)'),$year)
                                    ->groupBy('trimestre')->get();
            $declarationsS = DeclarationAccidentMateriel::select('semestre','unite',DB::raw('YEAR(date) as year'))
                                    ->where(DB::raw('YEAR(date)'),$year)
                                    ->groupBy('semestre')->get();
        }else{
            $declarations = DeclarationAccidentMateriel::select('unite',DB::raw('YEAR(date) as year'),DB::raw('MONTH(date) as mois'))
                                    ->where('unite',Auth::user()->unite)
                                    ->where(DB::raw('YEAR(date)'),$year)
                                    ->groupBy('mois')->get();
                                    
            $declarationsT = DeclarationAccidentMateriel::select('trimestre','unite',DB::raw('YEAR(date) as year'))
                                    ->where('unite',Auth::user()->unite)
                                    ->where(DB::raw('YEAR(date)'),$year)
                                    ->groupBy('trimestre')->get();
            
            $declarationsS = DeclarationAccidentMateriel::select('semestre','unite',DB::raw('YEAR(date) as year'))
                                    ->where('unite',Auth::user()->unite)
                                    ->where(DB::raw('YEAR(date)'),$year)
                                    ->groupBy('semestre')->get();
        }

         return view('HSE.BAM.detail')->with([
             'declarations' => $declarations,
             'declarationsT' => $declarationsT,
             'declarationsS' => $declarationsS,
             'year' => $year,
         ]);
    }
    
    public function parMois($mois,$year)
    {
        if (Auth::user()->is_admin) {
            $declarations = DeclarationAccidentMateriel::where(DB::raw('MONTH(date)'),$mois)
                                    ->where(DB::raw('YEAR(date)'),$year)
                                    ->get();
        }else{
            $declarations = DeclarationAccidentMateriel::where('unite',Auth::user()->unite)
                                    ->where(DB::raw('MONTH(date)'),$mois)
                                    ->where(DB::raw('YEAR(date)'),$year)
                                    ->get();
        }

         return view('HSE.BAM.liste')->with([
             'declarations' => $declarations,
             'mois' => $mois,
             'year' => $year,
         ]);
    }
    
    public function parTrimestre($t,$year)
    {
        if (Auth::user()->is_admin) {
            $declarations = DeclarationAccidentMateriel::where('trimestre',$t)
                                    ->where(DB::raw('YEAR(date)'),$year)
                                    ->get();

        }else{
            $declarations = DeclarationAccidentMateriel::where('unite',Auth::user()->unite)
                                    ->where('trimestre',$t)
                                    ->where(DB::raw('YEAR(date)'),$year)
                                    ->get();
        }

         return view('HSE.BAM.liste')->with([
             'declarations' => $declarations,
             't' => $t,
             'year' => $year,
         ]);
    }
    
    public function parSemestre($s,$year)
    {
        if (Auth::user()->is_admin) {
            $declarations = DeclarationAccidentMateriel::where('semestre',$s)
                                    ->where(DB::raw('YEAR(date)'),$year)
                                    ->get();
        }else{
            $declarations = DeclarationAccidentMateriel::where('unite',Auth::user()->unite)
                                    ->where('semestre',$s)
                                    ->where(DB::raw('YEAR(date)'),$year)
                                    ->get();
        }

         return view('HSE.BAM.liste')->with([
             'declarations' => $declarations,
             's' => $s,
             'year' => $year,
         ]);
    }
}
