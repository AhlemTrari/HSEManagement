<?php

namespace App\Http\Controllers;

use App\Employe;
use Illuminate\Http\Request;
use App\DeclarationAccidentMateriel;
use Illuminate\Support\Facades\Auth;

class DamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        if (Auth::user()->is_admin) {
            $declarations = DeclarationAccidentMateriel::all();
        }else{
            $declarations = DeclarationAccidentMateriel::where('unite',Auth::user()->unite)->get();
        }
         return view('HSE.DAM.index')->with([
            'declarations' => $declarations,
        ]);
    }
    public function create()
    {
        $employes = Employe::all();
         return view('HSE.DAM.create')->with([
             'employes' => $employes,
         ]);
    }
    public function store(Request $request)
    {
        $year =  now()->year;
        $year = substr( $year,-2);
        
        $last = DeclarationAccidentMateriel::all()->last();
        
        $declaration = new DeclarationAccidentMateriel();

        if ($last && $last->created_at->year == now()->year) {
            $n = $last->num;
            $num = substr( $n,0,4);
            $num +=1;
            $num = str_pad($num, 4, '0', STR_PAD_LEFT);

        }else{
            $num = "0001";
        }
        
        $declaration->num = $num."/".$year;
        $declaration->unite = Auth::user()->unite;
        $declaration->autre_victimes = $request->input('autre_victimes');
        $declaration->libelle = $request->input('libelle');
        $declaration->chantier = $request->input('chantier');
        $declaration->lieu = $request->input('lieu');
        $declaration->date = $request->input('date');
        $declaration->heure = $request->input('heure');
        $declaration->travail_courrant = $request->input('travail_courrant');
        $declaration->materiel = $request->input('materiel');
        $declaration->cause_direct = $request->input('cause_direct');
        $declaration->cause_indirect = $request->input('cause_indirect');
        $declaration->consequences = $request->input('consequences');
        if ($request->input('if_tiers')) {
            $declaration->tiers_nom = $request->input('tiers_nom');
            $declaration->tiers_prenom = $request->input('tiers_prenom');
            $declaration->tiers_adress = $request->input('tiers_adress');
            // $declaration->tiers_id = $request->input('tiers_id');
        }
        $declaration->temoins = $request->input('temoins');
        if ($request->input('if_constatation_police')) {
            $declaration->constatation_police = $request->input('constatation_police');
        }
        $declaration->circonstances_detaillees = $request->input('circonstances_detaillees');
        $declaration->employe_id = $request->input('employe_id');

        $declaration->save();
        return redirect('/DeclarationAccidentM');
    }

    public function show($id){
        $declaration = DeclarationAccidentMateriel::find($id);
        return view('HSE.DAM.show')->with([
            'declaration' => $declaration,
        ]);
    }

}
