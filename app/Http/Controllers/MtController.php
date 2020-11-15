<?php

namespace App\Http\Controllers;

use App\Amenagement;
use App\Employe;
use App\Exports\MedcineTravailExportView;
use App\Exports\MedcineTravailMensuelExportView;
use App\Exports\MedcineTravailSemestrielExportView;
use App\Exports\MedcineTravailTrimestrielExportView;
use App\MedcineTravail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class MtController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        if (Auth::user()->is_admin) {
            $canevas = MedcineTravail::select('unite',DB::raw('YEAR(visite_periodique) as year'))
                                    ->groupBy('year','unite')->get();
        }else{
            $canevas = MedcineTravail::select(DB::raw('YEAR(visite_periodique) as year'))
                                        ->where('unite',Auth::user()->unite)
                                        ->groupBy('year')->get();
        }
        $employes = Employe::where('unite',Auth::user()->unite)->get();
         return view('HSE.MT.index')->with([
             'canevas' => $canevas,
             'employes' => $employes,
         ]);
    }
    public function detail($year)
    {
        if (Auth::user()->is_admin) {
            $canevas = MedcineTravail::select('unite',DB::raw('YEAR(visite_periodique) as year'),DB::raw('MONTH(visite_periodique) as mois'))
                                    ->where(DB::raw('YEAR(visite_periodique)'),$year)
                                    ->groupBy('mois')->get();
            $canevasT = MedcineTravail::select('trimestre','unite',DB::raw('YEAR(visite_periodique) as year'),DB::raw('MONTH(visite_periodique) as mois'))
                                    ->where(DB::raw('YEAR(visite_periodique)'),$year)
                                    ->groupBy('trimestre')->get();
            $canevasS = MedcineTravail::select('semestre','unite',DB::raw('YEAR(visite_periodique) as year'),DB::raw('MONTH(visite_periodique) as mois'))
                                    ->where(DB::raw('YEAR(visite_periodique)'),$year)
                                    ->groupBy('semestre')->get();

                                    
            $visite_embauche = Employe::whereYear('date_rec',$year)
                                ->where('visite_embauche','Oui')->count();
            $visite_periodique = MedcineTravail::whereYear('visite_periodique',$year)->count();
            $radiographie = MedcineTravail::whereYear('radiographie',$year)->count();
            $examen_bio = MedcineTravail::whereYear('examen_bio',$year)->count();
            $amenagements = Amenagement::whereYear('created_at',$year)->count();

        }else{
            $canevas = MedcineTravail::select('unite',DB::raw('YEAR(visite_periodique) as year'),DB::raw('MONTH(visite_periodique) as mois'))
                                    ->where('unite',Auth::user()->unite)
                                    ->where(DB::raw('YEAR(visite_periodique)'),$year)
                                    ->groupBy('mois')->get();;
                                    
            $canevasT = MedcineTravail::select('trimestre','unite',DB::raw('YEAR(visite_periodique) as year'),DB::raw('MONTH(visite_periodique) as mois'))
                                    ->where('unite',Auth::user()->unite)
                                    ->where(DB::raw('YEAR(visite_periodique)'),$year)
                                    ->groupBy('trimestre')->get();
            
            $canevasS = MedcineTravail::select('semestre','unite',DB::raw('YEAR(visite_periodique) as year'),DB::raw('MONTH(visite_periodique) as mois'))
                                    ->where('unite',Auth::user()->unite)
                                    ->where(DB::raw('YEAR(visite_periodique)'),$year)
                                    ->groupBy('semestre')->get();
                                    
            $visite_embauche = Employe::whereYear('date_rec',$year)
                                    ->where('visite_embauche','Oui')
                                    ->where('unite',Auth::user()->unite)->count();
            $visite_periodique = MedcineTravail::whereYear('visite_periodique',$year)
                                         ->where('unite',Auth::user()->unite)->count();
            $radiographie = MedcineTravail::whereYear('radiographie',$year)
                                        ->where('unite',Auth::user()->unite)->count();
            $examen_bio = MedcineTravail::whereYear('examen_bio',$year)
                                        ->where('unite',Auth::user()->unite)->count();
                                        
            $amenagements = Amenagement::whereYear('created_at',$year)
                                        ->whereHas('employe', function ($query) {
                                            return $query->where('unite', '=', Auth::user()->unite);
                                        })->count();
        }


        $employes = Employe::where('unite',Auth::user()->unite)->get();
         return view('HSE.MT.detail')->with([
             'canevas' => $canevas,
             'canevasT' => $canevasT,
             'canevasS' => $canevasS,
             'employes' => $employes,
             'visite_embauche' => $visite_embauche,
             'visite_periodique' => $visite_periodique,
             'radiographie' => $radiographie,
             'examen_bio' => $examen_bio,
             'amenagements' => $amenagements,
             'year' => $year,
         ]);
    }
    public function exportAnnuel($year)
    {
        return Excel::download(new MedcineTravailExportView($year),'medcineDeTravail.xlsx');
    }
    public function exportMensuel($mois,$year)
    {
        return Excel::download(new MedcineTravailMensuelExportView($mois,$year),'medcineDeTravail.xlsx');
    }
    public function exportTrimestriel($t,$year)
    {
        return Excel::download(new MedcineTravailTrimestrielExportView($t,$year),'medcineDeTravail.xlsx');
    }
    public function exportSemestriel($s,$year)
    {
        return Excel::download(new MedcineTravailSemestrielExportView($s,$year),'medcineDeTravail.xlsx');
    }
    public function parMois($mois,$year)
    {
        if (Auth::user()->is_admin) {
            $canevas = MedcineTravail::where(DB::raw('MONTH(visite_periodique)'),$mois)
                                    ->where(DB::raw('YEAR(visite_periodique)'),$year)
                                    ->get();
                                    
            $visite_embauche = Employe::whereYear('date_rec',$year)
                                ->where(DB::raw('MONTH(date_rec)'),$mois)
                                ->where('visite_embauche','Oui')->count();
            $visite_periodique = MedcineTravail::whereYear('visite_periodique',$year)
                                ->where(DB::raw('MONTH(visite_periodique)'),$mois)->count();
            $radiographie = MedcineTravail::whereYear('radiographie',$year)
                            ->where(DB::raw('MONTH(radiographie)'),$mois)->count() ;
            $examen_bio = MedcineTravail::whereYear('examen_bio',$year)
                            ->where(DB::raw('MONTH(examen_bio)'),$mois)->count();
            $amenagements = Amenagement::whereYear('created_at',$year)
                            ->where(DB::raw('MONTH(created_at)'),$mois)->count();
        }else{
            $canevas = MedcineTravail::where('unite',Auth::user()->unite)
                                    ->where(DB::raw('MONTH(visite_periodique)'),$mois)
                                    ->where(DB::raw('YEAR(visite_periodique)'),$year)
                                    ->get();
                                    
            $visite_embauche = Employe::whereYear('date_rec',$year)
                                ->where(DB::raw('MONTH(date_rec)'),$mois)
                                ->where('visite_embauche','Oui')
                                ->where('unite',Auth::user()->unite)->count();
            $visite_periodique = MedcineTravail::whereYear('visite_periodique',$year)
                                ->where(DB::raw('MONTH(visite_periodique)'),$mois)
                                ->where('unite',Auth::user()->unite)->count();
            $radiographie = MedcineTravail::whereYear('radiographie',$year)
                            ->where(DB::raw('MONTH(radiographie)'),$mois)
                            ->where('unite',Auth::user()->unite)->count() ;
            $examen_bio = MedcineTravail::whereYear('examen_bio',$year)
                            ->where(DB::raw('MONTH(examen_bio)'),$mois)
                            ->where('unite',Auth::user()->unite)->count();
            $amenagements = Amenagement::whereYear('created_at',$year)
                            ->where(DB::raw('MONTH(created_at)'),$mois)
                            ->whereHas('employe', function ($query) {
                                return $query->where('unite', '=', Auth::user()->unite);
                            })->count();
        }

         return view('HSE.MT.liste')->with([
             'canevas' => $canevas,
             'mois' => $mois,
             'year' => $year,
             'visite_embauche' => $visite_embauche,
             'visite_periodique' => $visite_periodique,
             'radiographie' => $radiographie,
             'amenagements' => $amenagements,
             'examen_bio' => $examen_bio,
         ]);
    }
    public function parTrimestre($t,$year)
    {
        if ($t == 'T1') {
            $mois = [1,2,3];
        }elseif ($t == 'T2') {
            $mois = [4,5,6];
        }elseif ($t == 'T3') {
            $mois = [7,8,9];
        }else {
            $mois = [10,11,12];
        }

        if (Auth::user()->is_admin) {
            $canevas = MedcineTravail::where('trimestre',$t)
                                    ->where(DB::raw('YEAR(visite_periodique)'),$year)
                                    ->get();
                                    
            $visite_embauche = Employe::whereYear('date_rec',$year)
                    ->whereIn(DB::raw('MONTH(date_rec)'),$mois)
                    ->where('visite_embauche','Oui')->count();
            $visite_periodique = MedcineTravail::whereYear('visite_periodique',$year)
                                ->whereIn(DB::raw('MONTH(visite_periodique)'),$mois)->count();
            $radiographie = MedcineTravail::whereYear('radiographie',$year)
                            ->whereIn(DB::raw('MONTH(radiographie)'),$mois)->count() ;
            $examen_bio = MedcineTravail::whereYear('examen_bio',$year)
                            ->whereIn(DB::raw('MONTH(examen_bio)'),$mois)->count();
            $amenagements = Amenagement::whereYear('created_at',$year)
                            ->whereIn(DB::raw('MONTH(created_at)'),$mois)->count();

        }else{
            $canevas = MedcineTravail::where('unite',Auth::user()->unite)
                                    ->where('trimestre',$t)
                                    ->where(DB::raw('YEAR(visite_periodique)'),$year)
                                    ->get();
            $visite_embauche = Employe::whereYear('date_rec',$year)
                    ->whereIn(DB::raw('MONTH(date_rec)'),$mois)
                    ->where('visite_embauche','Oui')
                    ->where('unite',Auth::user()->unite)->count();
            $visite_periodique = MedcineTravail::whereYear('visite_periodique',$year)
                                ->whereIn(DB::raw('MONTH(visite_periodique)'),$mois)
                                ->where('unite',Auth::user()->unite)->count();
            $radiographie = MedcineTravail::whereYear('radiographie',$year)
                            ->whereIn(DB::raw('MONTH(radiographie)'),$mois)
                            ->where('unite',Auth::user()->unite)->count() ;
            $examen_bio = MedcineTravail::whereYear('examen_bio',$year)
                            ->whereIn(DB::raw('MONTH(examen_bio)'),$mois)
                            ->where('unite',Auth::user()->unite)->count();
            $amenagements = Amenagement::whereYear('created_at',$year)
                            ->whereIn(DB::raw('MONTH(created_at)'),$mois)
                            ->whereHas('employe', function ($query) {
                                return $query->where('unite', '=', Auth::user()->unite);
                            })->count();
        }

         return view('HSE.MT.listeTrimestre')->with([
             'canevas' => $canevas,
             't' => $t,
             'year' => $year,
             'visite_embauche' => $visite_embauche,
             'visite_periodique' => $visite_periodique,
             'radiographie' => $radiographie,
             'examen_bio' => $examen_bio,
             'amenagements' => $amenagements,
         ]);
    }
    public function parSemestre($s,$year)
    {
        if ($s == 'S1') {
            $mois = [1,2,3,4,5,6];
        }else {
            $mois = [7,8,9,10,11,12];
        }

        if (Auth::user()->is_admin) {
            $canevas = MedcineTravail::where('semestre',$s)
                                    ->where(DB::raw('YEAR(visite_periodique)'),$year)
                                    ->get();

            $visite_embauche = Employe::whereYear('date_rec',$year)
                                    ->whereIn(DB::raw('MONTH(date_rec)'),$mois)
                                    ->where('visite_embauche','Oui')->count();
            $visite_periodique = MedcineTravail::whereYear('visite_periodique',$year)
                                                ->whereIn(DB::raw('MONTH(visite_periodique)'),$mois)->count();
            $radiographie = MedcineTravail::whereYear('radiographie',$year)
                                            ->whereIn(DB::raw('MONTH(radiographie)'),$mois)->count() ;
            $examen_bio = MedcineTravail::whereYear('examen_bio',$year)
                                            ->whereIn(DB::raw('MONTH(examen_bio)'),$mois)->count();
            $amenagements = Amenagement::whereYear('created_at',$year)
                            ->whereIn(DB::raw('MONTH(created_at)'),$mois)->count();
        }else{
            $canevas = MedcineTravail::where('unite',Auth::user()->unite)
                                    ->where('semestre',$s)
                                    ->where(DB::raw('YEAR(visite_periodique)'),$year)
                                    ->get();
            $visite_embauche = Employe::whereYear('date_rec',$year)
                                    ->whereIn(DB::raw('MONTH(date_rec)'),$mois)
                                    ->where('unite',Auth::user()->unite)
                                    ->where('visite_embauche','Oui')->count();
            $visite_periodique = MedcineTravail::whereYear('visite_periodique',$year)
                                                ->whereIn(DB::raw('MONTH(visite_periodique)'),$mois)
                                                ->where('unite',Auth::user()->unite)->count();
            $radiographie = MedcineTravail::whereYear('radiographie',$year)
                                            ->whereIn(DB::raw('MONTH(radiographie)'),$mois)
                                            ->where('unite',Auth::user()->unite)->count() ;
            $examen_bio = MedcineTravail::whereYear('examen_bio',$year)
                                            ->whereIn(DB::raw('MONTH(examen_bio)'),$mois)
                                            ->where('unite',Auth::user()->unite)->count();
            $amenagements = Amenagement::whereYear('created_at',$year)
                            ->whereIn(DB::raw('MONTH(created_at)'),$mois)
                            ->whereHas('employe', function ($query) {
                                return $query->where('unite', '=', Auth::user()->unite);
                            })->count();
        }

        

         return view('HSE.MT.listeSemestre')->with([
             'canevas' => $canevas,
             's' => $s,
             'year' => $year,
             'visite_embauche' => $visite_embauche,
             'visite_periodique' => $visite_periodique,
             'radiographie' => $radiographie,
             'examen_bio' => $examen_bio,
             'amenagements' => $amenagements,
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
        $canevas->employe_id = $request->input('employe_id');

        $employe = Employe::find($request->input('employe_id'));
        $canevas->affectation = $employe->affectation;

        $canevas->visite_periodique = $request->input('periodique');
        $canevas->radiographie = $request->input('radiographie');
        $canevas->examen_bio = $request->input('examen_bio');
        $canevas->observation = $request->input('observation');

        $date = strtotime($request->input('periodique'));

        if (in_array(date('M',$date), array('Jan','Feb','Mar'))) {
            $canevas->trimestre = 'T1';
            $canevas->semestre = 'S1';
        }elseif (in_array(date('M',$date), array('Apr','May','Jun'))) {
            $canevas->trimestre = 'T2';
            $canevas->semestre = 'S1';
        }elseif (in_array(date('M',$date), array('Jul','Aug','Sep'))) {
            $canevas->trimestre = 'T3';
            $canevas->semestre = 'S2';
        }else{
            $canevas->trimestre = 'T4';
            $canevas->semestre = 'S2';
        }

        $canevas->save();
        return back();
    }
    public function update(Request $request, $id)
    {
        $canevas = MedcineTravail::find($id);
        
        $canevas->visite_periodique = $request->input('periodique');
        $canevas->radiographie = $request->input('radiographie');
        $canevas->examen_bio = $request->input('examen_bio');
        $canevas->observation = $request->input('observation');

        $date = strtotime($request->input('periodique'));

        if (in_array(date('M',$date), array('Jan','Feb','Mar'))) {
            $canevas->trimestre = 'T1';
            $canevas->semestre = 'S1';
        }elseif (in_array(date('M',$date), array('Apr','May','Jun'))) {
            $canevas->trimestre = 'T2';
            $canevas->semestre = 'S1';
        }elseif (in_array(date('M',$date), array('Jul','Aug','Sep'))) {
            $canevas->trimestre = 'T3';
            $canevas->semestre = 'S2';
        }else{
            $canevas->trimestre = 'T4';
            $canevas->semestre = 'S2';
        }

        $canevas->save();
        return redirect('/MedcineDeTravail');
    }
    public function destroy($id){
    	$canevas = MedcineTravail::find($id);
        $canevas->delete();
        return back();
    }
}
