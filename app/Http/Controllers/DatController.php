<?php

namespace App\Http\Controllers;

use App\Employe;
use Illuminate\Http\Request;
use App\DeclarationAccidentTravail;
use Illuminate\Support\Facades\Auth;

class DatController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        if (Auth::user()->is_admin) {
            $declarations = DeclarationAccidentTravail::all();
        }else{
            $declarations = DeclarationAccidentTravail::where('unite',Auth::user()->unite)->get();
        }
         return view('HSE.DAT.index')->with([
            'declarations' => $declarations,
        ]);
    }
    public function create()
    {
        $employes = Employe::where('unite',Auth::user()->unite)->get();
         return view('HSE.DAT.create')->with([
             'employes' => $employes,
         ]);
    }
    public function edit($id)
    {
        $declaration = DeclarationAccidentTravail::find($id);
        $employes = Employe::where('unite',Auth::user()->unite)->get();
         return view('HSE.DAT.edit')->with([
             'employes' => $employes,
             'declaration' => $declaration,
         ]);
    }
    public function store(Request $request)
    {
        $year =  now()->year;
        $year = substr( $year,-2);
        
        $last = DeclarationAccidentTravail::all()->last();
        
        $declaration = new DeclarationAccidentTravail();

        if ($last && $last->created_at->year == now()->year) {
            $n = $last->num;
            $num = substr( $n,0,3);
            $num +=1;
            $num = str_pad($num, 3, '0', STR_PAD_LEFT);

        }else{
            $num = "001";
        }
        
        $declaration->num = $num."/".$year;
        $declaration->unite = Auth::user()->unite;
        $declaration->autre_victimes = $request->input('autre_victimes');
        $declaration->chantier = $request->input('chantier');
        $declaration->lieu = $request->input('lieu');
        $declaration->date = $request->input('date');
        $declaration->heure = $request->input('heure');
        $declaration->travail_courrant = $request->input('travail_courrant');
        $declaration->nature_lesion = $request->input('nature_lesion');
        $declaration->siege_lesion = $request->input('siege_lesion');
        $declaration->materiel = $request->input('materiel');
        $declaration->cause_direct = $request->input('cause_direct');
        $declaration->cause_indirect = $request->input('cause_indirect');
        $declaration->consequences = $request->input('consequences');
        if($request->input('consequences') == "Avec arrêt"){
            $declaration->nbr_arret = $request->input('nbr_arret');
        }
        $declaration->transporter_a = $request->input('transporter_a');
        $declaration->moyen_par = $request->input('moyen_par');
        $declaration->temoins = $request->input('temoins');
        $declaration->circonstances_detaillees = $request->input('circonstances_detaillees');
        if ($request->input('if_tiers')) {
            $declaration->tiers_id = $request->input('tiers_id');
        }
        $declaration->employe_id = $request->input('employe_id');

        $declaration->save();
        return redirect('/DeclarationAccidentT');
    }
    public function update($id, Request $request)
    {
        $declaration = DeclarationAccidentTravail::find($id);

        $declaration->autre_victimes = $request->input('autre_victimes');
        $declaration->chantier = $request->input('chantier');
        $declaration->lieu = $request->input('lieu');
        $declaration->date = $request->input('date');
        $declaration->heure = $request->input('heure');
        $declaration->travail_courrant = $request->input('travail_courrant');
        $declaration->nature_lesion = $request->input('nature_lesion');
        $declaration->siege_lesion = $request->input('siege_lesion');
        $declaration->materiel = $request->input('materiel');
        $declaration->cause_direct = $request->input('cause_direct');
        $declaration->cause_indirect = $request->input('cause_indirect');
        $declaration->consequences = $request->input('consequences');
        if($request->input('consequences') == "Avec arrêt"){
            $declaration->nbr_arret = $request->input('nbr_arret');
        }
        $declaration->transporter_a = $request->input('transporter_a');
        $declaration->moyen_par = $request->input('moyen_par');
        $declaration->temoins = $request->input('temoins');
        $declaration->circonstances_detaillees = $request->input('circonstances_detaillees');
        if ($request->input('if_tiers')) {
            $declaration->tiers_id = $request->input('tiers_id');
        }
        $declaration->employe_id = $request->input('employe_id');

        $declaration->save();
        return redirect('/DeclarationAccidentT');
    }

    public function show($id){
        $declaration = DeclarationAccidentTravail::find($id);
        return view('HSE.DAT.show')->with([
            'declaration' => $declaration,
        ]);
    }
    
    public function destroy($id)
    {
        $declaration = DeclarationAccidentTravail::find($id);
        try{
            $declaration->delete();
            return back();
        }catch(\Exception $e){
            return back()-> with('error', 'Ooops. Vous ne pouvez pas supprimer cette déclaration '); 
        }
    }
    
}
