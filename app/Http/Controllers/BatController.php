<?php

namespace App\Http\Controllers;

use App\AccidentParAnciennete;
use App\AccidentParFct;
use App\AccidentParHeur;
use App\AccidentParJour;
use App\AccidentParSiege;
use App\BilanAnnuel;
use App\BilanMensuel;
use App\BilanSemestriel;
use App\BilanTrimestriel;
use App\Fonction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (Auth::user()->is_admin) {
            $bilans = DB::table('bilan_annuels')
                        ->select('*')
                        ->groupBy('annee')
                        ->get();

        }else{
            $bilans = BilanAnnuel::where('unite', Auth::user()->unite)
                                    ->get();
        }
        $acces = 1;
        
        if ($bilans->isNotEmpty()) {
            if ($bilans->last()->annee >= now()->year) {
                $acces = 0;
            } 
        }
         return view('HSE.BAT.index')->with([
            'bilans' => $bilans,
            'acces' =>$acces,
         ]);
    }

    public function create()
    {
        $fcts = Fonction::all();
         return view('HSE.BAT.create')->with([
            'fonctions' => $fcts,
         ]);
    }

    public function details($annee)
    {
        $bilanTerga = BilanAnnuel::where('unite', 1)
                        ->where('annee',$annee)
                        ->first();
        $bilanHennaya = BilanAnnuel::where('unite', 2)
                        ->where('annee',$annee)
                        ->first();

        if (Auth::user()->is_admin) {
            $bilans = DB::table('bilan_mensuels')
            ->select('*')
            ->where('annee',$annee)
            ->groupBy('mois')
            ->get();
            $bilanAnnuel = BilanAnnuel::where('annee',$annee)->get();
            $bilansTrimestriel = DB::table('bilan_trimestriels')
            ->select('*')
            ->where('annee',$annee)
            ->groupBy('trimestre')
            ->get();

            $bilansSemestriel = DB::table('bilan_semestriels')
            ->select('*')
            ->where('annee',$annee)
            ->groupBy('semestre')
            ->get();

        }else {
            $bilans = BilanMensuel::where('annee', $annee)
                    ->where('unite', Auth::user()->unite)
                    ->get();
            
            $bilanAnnuel = BilanAnnuel::where('annee',$annee)
                    ->where('unite', Auth::user()->unite)
                    ->first();
            $bilansTrimestriel = BilanTrimestriel::where('annee', $annee)
                    ->where('unite', Auth::user()->unite)
                    ->get();
            $bilansSemestriel = BilanSemestriel::where('annee', $annee)
                    ->where('unite', Auth::user()->unite)
                    ->get();
        }
        
        return view('HSE.BAT.details')->with([
            'annee' => $annee,
            'bilans' => $bilans,
            'bilanAnnuel' => $bilanAnnuel,
            'bilansTrimestriel' => $bilansTrimestriel,
            'bilansSemestriel' => $bilansSemestriel,
            'bilanTerga' => $bilanTerga,
            'bilanHennaya' => $bilanHennaya,
            // 'acces' => $acces,
         ]);
    }

    public function store(Request $request)
    {
        $bilans = BilanMensuel::where('annee',$request->input('annee'))
                                ->where('mois',$request->input('mois'))
                                ->where('unite_id',Auth::user()->unite_id)
                                ->get();
        if ($bilans->isNotEmpty()) {
            return back()->with('warning', "Bilan existe déja");
        }

        $bilanAnnuel = BilanAnnuel::where('annee',$request->input('annee'))->first();

        if (!$bilanAnnuel) {
            $bilanAnnuel = new BilanAnnuel();
            $bilanAnnuel->annee = $request->input('annee');
            $bilanAnnuel->unite_id = Auth::user()->unite_id;
            $bilanAnnuel->save();
        } 
        
        $bilan = new BilanMensuel();
        
        if (in_array($request->input('mois'),array('Janvier','Février','Mars','Avril','Mai','Juin'))) {

            $bs = BilanSemestriel::where('annee',$request->input('annee'))
                                    ->where('semestre','S1')->first();
            if ($bs->isNotEmpty()) {
                $bilanSemestriel = new BilanSemestriel();
                $bilanSemestriel->annee = $request->input('annee');
                $bilanSemestriel->semestre = 'S1';
                $bilanSemestriel->unite_id = Auth::user()->unite_id;
                $bilanSemestriel->bilan_annuel_id = $bilanAnnuel->id;
                $bilanSemestriel->save();
            } else {
                # code...
            }

            if (in_array($request->input('mois'),array('Janvier','Février','Mars') )) {
                $b= BilanTrimestriel::where('annee',$request->input('annee'))
                                    ->where('trimestre','T1')->first();
            }

            if (in_array($request->input('mois'),array('Avril','Mai','Juin'))) {
                $b= BilanTrimestriel::where('annee',$request->input('annee'))
                                    ->where('trimestre','T1')->first();
            }

            if ( $request->input('mois') == 'Janvier') {
                
                
                $bilanTrimestriel = new BilanTrimestriel();
                $bilanTrimestriel->annee = $request->input('annee');
                $bilanTrimestriel->trimestre = 'T1';
                $bilanTrimestriel->unite_id = Auth::user()->unite_id;
                $bilanTrimestriel->bilan_annuel_id = $bilanAnnuel->id;
                $bilanTrimestriel->save();

                $bilan->bilan_annuel_id = $bilanAnnuel->id;
                $bilan->bilan_semestriel_id = $bilanSemestriel->id;
                $bilan->bilan_trimestriel_id = $bilanTrimestriel->id;
            }
        } else {
            if($request->input('mois') == 'Avril'){
                $bilanTrimestriel = new BilanTrimestriel();
                $bilanTrimestriel->annee = $request->input('annee');
                $bilanTrimestriel->trimestre = 'T2';
                $bilanTrimestriel->unite_id = Auth::user()->unite_id;
                $bilanTrimestriel->bilan_annuel_id = $bilanAnnuel->id;
                $bilanTrimestriel->save();
    
                $bilan->bilan_annuel_id = $bilanAnnuel->id;
                $bilan->bilan_semestriel_id = BilanSemestriel::where('unite_id',Auth::user()->unite_id)
                                                            ->latest()->first()->id;
                $bilan->bilan_trimestriel_id = $bilanTrimestriel->id;
            }
            elseif($request->input('mois') == 'Juillet'){
                $bilanTrimestriel = new BilanTrimestriel();
                $bilanTrimestriel->annee = $request->input('annee');
                $bilanTrimestriel->trimestre = 'T3';
                $bilanTrimestriel->unite_id = Auth::user()->unite_id;
                $bilanTrimestriel->bilan_annuel_id = $bilanAnnuel->id;
                $bilanTrimestriel->save();
    
                $bilanSemestriel = new BilanSemestriel();
                $bilanSemestriel->annee = $request->input('annee');
                $bilanSemestriel->semestre = 'S2';
                $bilanSemestriel->unite_id = Auth::user()->unite_id;
                $bilanSemestriel->bilan_annuel_id = $bilanAnnuel->id;
                $bilanSemestriel->save();
    
                $bilan->bilan_annuel_id = $bilanAnnuel->id;
                $bilan->bilan_semestriel_id = $bilanSemestriel->id;
                $bilan->bilan_trimestriel_id = $bilanTrimestriel->id;
            }
            elseif($request->input('mois') == 'Octobre'){
                $bilanTrimestriel = new BilanTrimestriel();
                $bilanTrimestriel->annee = $request->input('annee');
                $bilanTrimestriel->trimestre = 'T4';
                $bilanTrimestriel->unite_id = Auth::user()->unite_id;
                $bilanTrimestriel->bilan_annuel_id = $bilanAnnuel->id;
                $bilanTrimestriel->save();
    
                $bilan->bilan_annuel_id = $bilanAnnuel->id;
                $bilan->bilan_semestriel_id = BilanSemestriel::where('unite_id',Auth::user()->unite_id)
                                                            ->latest()->first()->id;
                $bilan->bilan_trimestriel_id = $bilanTrimestriel->id;
            }
            else{
                $bilan->bilan_annuel_id = $bilanAnnuel->id;
                $bilan->bilan_semestriel_id = BilanSemestriel::where('unite_id',Auth::user()->unite_id)
                                                            ->latest()->first()->id;
                $bilan->bilan_trimestriel_id = BilanTrimestriel::where('unite_id',Auth::user()->unite_id)
                                                                ->latest()->first()->id;
            }
        }
            // $bilan->annee = now()->year;
            // $bilan->mois = now()->month;
            $bilan->annee = $request->input('annee');
            $bilan->mois = $request->input('mois');
            $bilan->nbr_accidents = $request->input('nbr_accidents');
            $bilan->nbr_jours = $request->input('nbr_jours');
            $bilan->unite_id = Auth::user()->unite_id;
            $bilan->save();

            $jours = ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'];
            for ($i=0; $i < 7; $i++) { 
                $p1 = new AccidentParJour();
                $p1->jour = $jours[$i];
                $p1->avec_arret = $request->input($i.'acc');
                $p1->sans_arret = $request->input($i.'jours');
                $p1->bilan_id = $bilan->id;
                $p1->save();
            }

            $heures = ['6h-8h','8h-10h','10h-12h','12h-13h','13h-15h','15h-17h','Autre'];
            for ($i=0; $i < 7; $i++) { 
                $p2 = new AccidentParHeur();
                $p2->heure = $heures[$i];
                $p2->nbr_accidents= $request->input($i.'accHeur');
                $p2->bilan_id = $bilan->id;
                $p2->save();
            }

            $siege_lesions = ['Yeux','Figure','Tête','Bassin','Membres inférieurs','Membres supérieurs','Pieds','Mains','Doigts','Thorax/ Lombaire'];
            for ($i=0; $i < 10; $i++) { 
                $p3 = new AccidentParSiege();
                $p3->siege_lesions = $siege_lesions[$i];
                $p3->nbr_accidents= $request->input($i.'accSiege');
                $p3->bilan_id = $bilan->id;
                $p3->save();
            }

            $anciennete = ['1 sem à 1 mois','1 mois à 3 mois','3 mois à 6 mois','6 mois à 1 an','1 an à 5 ans','5 ans et plus'];
            for ($i=0; $i < 6; $i++) { 
                $p4 = new AccidentParAnciennete();
                $p4->anciennete = $anciennete[$i];
                $p4->nbr_accidents= $request->input($i.'accAnciennete');
                $p4->bilan_id = $bilan->id;
                $p4->save();
            }
            
            $loop = $request->input('loop');
            for ($i=1; $i <= $loop; $i++) { 
                $p5 = new AccidentParFct();
                $p5->fonction = $request->input($i.'fct');
                $p5->nbr_accidents= $request->input($i.'accFct');
                $p5->bilan_id = $bilan->id;
                $p5->save();
            }

            return redirect('/BilanAccidentT/details/'.$bilan->annee);
    }

    public function showBilanMoisA($mois,$annee)
    {
        $bilanTerga = BilanMensuel::where('annee',$annee)
                                ->where('mois',$mois)
                                ->where('unite',1)
                                ->first();
        $bilanHennaya = BilanMensuel::where('annee',$annee)
                                ->where('mois',$mois)
                                ->where('unite',2)
                                ->first();
        //$bilans_ids[] = les ids des bilans mensuels 
        if ($bilanHennaya && $bilanTerga)
        {
        $consolideParJours = DB::table('accident_par_jours')
                                ->select(DB::raw('sum(avec_arret) as accidentsAvec, sum(sans_arret) as accidentsSans, jour'))
                                ->orderBy('created_at')
                                ->where('bilan_id',$bilanTerga->id)
                                ->orWhere('bilan_id',$bilanHennaya->id)
                                //whereIn('bilan_id',$bilans_ids)
                                ->groupBy('jour')
                                ->get();
        $consolideParHeur = DB::table('accident_par_heurs')
                                ->select(DB::raw('sum(nbr_accidents) as accidents, heure'))
                                ->orderBy('created_at')
                                ->where('bilan_id',$bilanTerga->id)
                                ->orWhere('bilan_id',$bilanHennaya->id)
                                ->groupBy('heure')
                                ->get();           
        $consolideParAnc = DB::table('accident_par_anciennetes')
                                ->select(DB::raw('sum(nbr_accidents) as accidents, anciennete'))
                                ->orderBy('created_at')
                                ->where('bilan_id',$bilanTerga->id)
                                ->orWhere('bilan_id',$bilanHennaya->id)
                                ->groupBy('anciennete')
                                ->get();    
        $consolideParSiege = DB::table('accident_par_sieges')
                                ->select(DB::raw('sum(nbr_accidents) as accidents, siege_lesions'))
                                ->orderBy('created_at')
                                ->where('bilan_id',$bilanTerga->id)
                                ->orWhere('bilan_id',$bilanHennaya->id)
                                ->groupBy('siege_lesions')
                                ->get();  
        $consolideParFct = DB::table('accident_par_fcts')
                                ->select(DB::raw('sum(nbr_accidents) as accidents, fonction'))
                                ->orderBy('created_at')
                                ->where('bilan_id',$bilanTerga->id)
                                ->orWhere('bilan_id',$bilanHennaya->id)
                                ->groupBy('fonction')
                                ->get();
        $accidents_total = $bilanHennaya->nbr_accidents + $bilanTerga->nbr_accidents;
        $jours_total = $bilanHennaya->nbr_jours + $bilanTerga->nbr_jours;
        $parJoursH = $bilanHennaya->accidentsParJour;
        foreach ($consolideParJours as $key => $value) {
            $totalParJour[] = $value->accidentsAvec + $value->accidentsSans;
        }
        
        }else{
            $accidents_total = null;
            $jours_total = null; 
            $totalParJour[]=null;
            $consolideParJours =null;
            $consolideParHeur =null;
            $consolideParSiege =null;
            $consolideParAnc =null;
            $consolideParFct =null;
        }
        
        if ($bilanHennaya) {
            $parJoursH = $bilanHennaya->accidentsParJour;
            foreach ($parJoursH as $key => $value) {
                $totalParJourH[] = $value->avec_arret + $value->sans_arret;
            }
        }else{
            $totalParJourH[]=null;
        }
        if ($bilanTerga) {
            $parJoursT = $bilanTerga->accidentsParJour;
        
            foreach ($parJoursT as $key => $value) {
                $totalParJourT[] = $value->avec_arret + $value->sans_arret;
            }
        }else{
            $totalParJourT[]=null;
        }
        
        return view('HSE.BAT.showBilanMoisAdmin')->with([
            'bilanHennaya' => $bilanHennaya,
            'bilanTerga' =>$bilanTerga,
            'totalParJourH' => $totalParJourH,
            'totalParJourT' => $totalParJourT,
            'totalParJour' => $totalParJour,
            'accidents_total' => $accidents_total,
            'jours_total' => $jours_total,
            'consolideParJours' => $consolideParJours,
            'consolideParHeur' => $consolideParHeur,
            'consolideParSiege' => $consolideParSiege,
            'consolideParAnc' => $consolideParAnc,
            'consolideParFct' => $consolideParFct,
            'mois' => $mois,
            'annee' => $annee,

         ]);
    }

    public function showBilanMois($id)
    {
        $bilan = BilanMensuel::find($id);
        $parJours = $bilan->accidentsParJour;
        foreach ($parJours as $key => $value) {
            $totalParJour[] = $value->avec_arret + $value->sans_arret;
        }
        return view('HSE.BAT.showBilanMois')->with([
            'bilan' => $bilan,
            'totalParJour' => $totalParJour,
         ]);
    }

    public function showBilanTrimestre($id)
    {
        $bilan = BilanTrimestriel::find($id);

        foreach ($bilan->bilanMensuel as $bilanMensuel) {
                $ids[] = $bilanMensuel->id;
        }
        
        $parMois = DB::table('bilan_mensuels')
                                ->select(DB::raw('sum(nbr_accidents) as accidents, sum(nbr_jours) as jours, mois'))
                                ->orderBy('created_at')
                                ->whereIn('id',$ids)
                                ->groupBy('mois')
                                ->get();
        $parJours = DB::table('accident_par_jours')
                                ->select(DB::raw('sum(avec_arret) as accidentsAvec, sum(sans_arret) as accidentsSans, jour'))
                                ->orderBy('created_at')
                                ->whereIn('bilan_id',$ids)
                                ->groupBy('jour')
                                ->get();
        $parHeur = DB::table('accident_par_heurs')
                                ->select(DB::raw('sum(nbr_accidents) as accidents, heure'))
                                ->orderBy('created_at')
                                ->whereIn('bilan_id',$ids)
                                ->groupBy('heure')
                                ->get();  
        $parSieges = DB::table('accident_par_sieges')
                                ->select(DB::raw('sum(nbr_accidents) as accidents, siege_lesions'))
                                ->orderBy('created_at')
                                ->whereIn('bilan_id',$ids)
                                ->groupBy('siege_lesions')
                                ->get(); 
        $parAnciennete = DB::table('accident_par_anciennetes')
                            ->select(DB::raw('sum(nbr_accidents) as accidents, anciennete'))
                            ->orderBy('created_at')
                            ->whereIn('bilan_id',$ids)
                            ->groupBy('anciennete')
                            ->get(); 
        $parFonction = DB::table('accident_par_fcts')
                        ->select(DB::raw('sum(nbr_accidents) as accidents, fonction'))
                        ->orderBy('created_at')
                        ->whereIn('bilan_id',$ids)
                        ->groupBy('fonction')
                        ->get();
        foreach ($parJours as $key => $value) {
            $totalParJour[] = $value->accidentsAvec + $value->accidentsSans;
        }
        return view('HSE.BAT.showBilanTrimestre')->with([
            'bilan' => $bilan,
            'parMois' => $parMois,
            'parJours' => $parJours,
            'totalParJour' => $totalParJour,
            'parHeur' => $parHeur,
            'parSieges' => $parSieges,
            'parAnciennete' => $parAnciennete,
            'parFonction' => $parFonction,
         ]);
    }

    public function showBilanTrimestreA($t,$annee)
    {
        $bilanH = BilanTrimestriel::where('annee',$annee)
                                    ->where('trimestre',$t)
                                    ->where('unite',2)
                                    ->first();

        $bilanT = BilanTrimestriel::where('annee',$annee)
                                    ->where('trimestre',$t)
                                    ->where('unite',1)
                                    ->first(); 
        if ($bilanH) {
            foreach ($bilanH->bilanMensuel as $bilanMensuel) {
                $idsH[] = $bilanMensuel->id;
            }
            $parMoisH = DB::table('bilan_mensuels')
                                    ->select(DB::raw('sum(nbr_accidents) as accidents, sum(nbr_jours) as jours, mois'))
                                    ->orderBy('created_at')
                                    ->whereIn('id',$idsH)
                                    ->groupBy('mois')
                                    ->get();
            $parJoursH = DB::table('accident_par_jours')
                                    ->select(DB::raw('sum(avec_arret) as accidentsAvec, sum(sans_arret) as accidentsSans, jour'))
                                    ->orderBy('created_at')
                                    ->whereIn('bilan_id',$idsH)
                                    ->groupBy('jour')
                                    ->get();
            $parHeurH = DB::table('accident_par_heurs')
                                    ->select(DB::raw('sum(nbr_accidents) as accidents, heure'))
                                    ->orderBy('created_at')
                                    ->whereIn('bilan_id',$idsH)
                                    ->groupBy('heure')
                                    ->get();  
            $parSiegesH = DB::table('accident_par_sieges')
                                    ->select(DB::raw('sum(nbr_accidents) as accidents, siege_lesions'))
                                    ->orderBy('created_at')
                                    ->whereIn('bilan_id',$idsH)
                                    ->groupBy('siege_lesions')
                                    ->get(); 
            $parAncienneteH = DB::table('accident_par_anciennetes')
                                ->select(DB::raw('sum(nbr_accidents) as accidents, anciennete'))
                                ->orderBy('created_at')
                                ->whereIn('bilan_id',$idsH)
                                ->groupBy('anciennete')
                                ->get(); 
            $parFonctionH = DB::table('accident_par_fcts')
                            ->select(DB::raw('sum(nbr_accidents) as accidents, fonction'))
                            ->orderBy('created_at')
                            ->whereIn('bilan_id',$idsH)
                            ->groupBy('fonction')
                            ->get();
            foreach ($parJoursH as $key => $value) {
                $totalParJourH[] = $value->accidentsAvec + $value->accidentsSans;
            }
        }else{
            $parMoisH = null;
            $parJoursH = null;
            $totalParJourH = null;
            $parHeurH = null;
            $parSiegesH = null;
            $parAncienneteH = null;
            $parFonctionH = null;
        }
        if ($bilanT) {
            foreach ($bilanT->bilanMensuel as $bilanMensuel) {
                $idsT[] = $bilanMensuel->id;
            }
            $parMoisT = DB::table('bilan_mensuels')
                                    ->select(DB::raw('sum(nbr_accidents) as accidents, sum(nbr_jours) as jours, mois'))
                                    ->orderBy('created_at')
                                    ->whereIn('id',$idsT)
                                    ->groupBy('mois')
                                    ->get();
            $parJoursT = DB::table('accident_par_jours')
                                    ->select(DB::raw('sum(avec_arret) as accidentsAvec, sum(sans_arret) as accidentsSans, jour'))
                                    ->orderBy('created_at')
                                    ->whereIn('bilan_id',$idsT)
                                    ->groupBy('jour')
                                    ->get();
            $parHeurT = DB::table('accident_par_heurs')
                                    ->select(DB::raw('sum(nbr_accidents) as accidents, heure'))
                                    ->orderBy('created_at')
                                    ->whereIn('bilan_id',$idsT)
                                    ->groupBy('heure')
                                    ->get();  
            $parSiegesT = DB::table('accident_par_sieges')
                                    ->select(DB::raw('sum(nbr_accidents) as accidents, siege_lesions'))
                                    ->orderBy('created_at')
                                    ->whereIn('bilan_id',$idsT)
                                    ->groupBy('siege_lesions')
                                    ->get(); 
            $parAncienneteT = DB::table('accident_par_anciennetes')
                                ->select(DB::raw('sum(nbr_accidents) as accidents, anciennete'))
                                ->orderBy('created_at')
                                ->whereIn('bilan_id',$idsT)
                                ->groupBy('anciennete')
                                ->get(); 
            $parFonctionT = DB::table('accident_par_fcts')
                            ->select(DB::raw('sum(nbr_accidents) as accidents, fonction'))
                            ->orderBy('created_at')
                            ->whereIn('bilan_id',$idsT)
                            ->groupBy('fonction')
                            ->get();
            foreach ($parJoursT as $key => $value) {
                $totalParJourT[] = $value->accidentsAvec + $value->accidentsSans;
            }
        }else{
            $parMoisT = null;
            $parJoursT = null;
            $totalParJourT = null;
            $parHeurT = null;
            $parSiegesT = null;
            $parAncienneteT = null;
            $parFonctionT = null;
        }
        if ($bilanH && $bilanT) {
            $parMoisC = DB::table('bilan_mensuels')
                                    ->select(DB::raw('sum(nbr_accidents) as accidents, sum(nbr_jours) as jours, mois'))
                                    ->orderBy('created_at')
                                    ->whereIn('id',$idsT)
                                    ->orWhereIn('id',$idsH)
                                    ->groupBy('mois')
                                    ->get();
            $parJoursC = DB::table('accident_par_jours')
                                    ->select(DB::raw('sum(avec_arret) as accidentsAvec, sum(sans_arret) as accidentsSans, jour'))
                                    ->orderBy('created_at')
                                    ->whereIn('bilan_id',$idsT)
                                    ->orWhereIn('bilan_id',$idsH)
                                    ->groupBy('jour')
                                    ->get();
            
            $parHeurC = DB::table('accident_par_heurs')
                                    ->select(DB::raw('sum(nbr_accidents) as accidents, heure'))
                                    ->orderBy('created_at')
                                    ->whereIn('bilan_id',$idsT)
                                    ->orWhereIn('bilan_id',$idsH)
                                    ->groupBy('heure')
                                    ->get();  
            $parSiegesC = DB::table('accident_par_sieges')
                                    ->select(DB::raw('sum(nbr_accidents) as accidents, siege_lesions'))
                                    ->orderBy('created_at')
                                    ->whereIn('bilan_id',$idsT)
                                    ->orWhereIn('bilan_id',$idsH)
                                    ->groupBy('siege_lesions')
                                    ->get(); 
            $parAncienneteC = DB::table('accident_par_anciennetes')
                                ->select(DB::raw('sum(nbr_accidents) as accidents, anciennete'))
                                ->orderBy('created_at')
                                ->whereIn('bilan_id',$idsT)
                                ->orWhereIn('bilan_id',$idsH)
                                ->groupBy('anciennete')
                                ->get(); 
            $parFonctionC = DB::table('accident_par_fcts')
                            ->select(DB::raw('sum(nbr_accidents) as accidents, fonction'))
                            ->orderBy('created_at')
                            ->whereIn('bilan_id',$idsT)
                            ->orWhereIn('bilan_id',$idsH)
                            ->groupBy('fonction')
                            ->get();
            foreach ($parJoursC as $key => $value) {
                $totalParJourC[] = $value->accidentsAvec + $value->accidentsSans;
            }
        }else{
            $parMoisC = null;
            $parJoursC = null;
            $totalParJourC = null;
            $parHeurC = null;
            $parSiegesC = null;
            $parAncienneteC = null;
            $parFonctionC = null;
        }

        return view('HSE.BAT.showBilanTrimestreAdmin')->with([
            'bilanH' => $bilanH,
            'parMoisH' => $parMoisH,
            'parJoursH' => $parJoursH,
            'totalParJourH' => $totalParJourH,
            'parHeurH' => $parHeurH,
            'parSiegesH' => $parSiegesH,
            'parAncienneteH' => $parAncienneteH,
            'parFonctionH' => $parFonctionH,
            'bilanT' => $bilanT,
            'parMoisT' => $parMoisT,
            'parJoursT' => $parJoursT,
            'totalParJourT' => $totalParJourT,
            'parHeurT' => $parHeurT,
            'parSiegesT' => $parSiegesT,
            'parAncienneteT' => $parAncienneteT,
            'parFonctionT' => $parFonctionT,
            'parMoisC' => $parMoisC,
            'parJoursC' => $parJoursC,
            'totalParJourC' => $totalParJourC,
            'parHeurC' => $parHeurC,
            'parSiegesC' => $parSiegesC,
            'parAncienneteC' => $parAncienneteC,
            'parFonctionC' => $parFonctionC,
            't' => $t,
            'annee' => $annee,
         ]);
    }
    public function showBilanSemestre($id)
    {
        $bilan = BilanSemestriel::find($id);

        foreach ($bilan->bilanMensuel as $bilanMensuel) {
                $ids[] = $bilanMensuel->id;
        }
        
        $parMois = DB::table('bilan_mensuels')
                                ->select(DB::raw('sum(nbr_accidents) as accidents, sum(nbr_jours) as jours, mois'))
                                ->orderBy('created_at')
                                ->whereIn('id',$ids)
                                ->groupBy('mois')
                                ->get();
        $parJours = DB::table('accident_par_jours')
                                ->select(DB::raw('sum(avec_arret) as accidentsAvec, sum(sans_arret) as accidentsSans, jour'))
                                ->orderBy('created_at')
                                ->whereIn('bilan_id',$ids)
                                ->groupBy('jour')
                                ->get();
        $parHeur = DB::table('accident_par_heurs')
                                ->select(DB::raw('sum(nbr_accidents) as accidents, heure'))
                                ->orderBy('created_at')
                                ->whereIn('bilan_id',$ids)
                                ->groupBy('heure')
                                ->get();  
        $parSieges = DB::table('accident_par_sieges')
                                ->select(DB::raw('sum(nbr_accidents) as accidents, siege_lesions'))
                                ->orderBy('created_at')
                                ->whereIn('bilan_id',$ids)
                                ->groupBy('siege_lesions')
                                ->get(); 
        $parAnciennete = DB::table('accident_par_anciennetes')
                            ->select(DB::raw('sum(nbr_accidents) as accidents, anciennete'))
                            ->orderBy('created_at')
                            ->whereIn('bilan_id',$ids)
                            ->groupBy('anciennete')
                            ->get(); 
        $parFonction = DB::table('accident_par_fcts')
                        ->select(DB::raw('sum(nbr_accidents) as accidents, fonction'))
                        ->orderBy('created_at')
                        ->whereIn('bilan_id',$ids)
                        ->groupBy('fonction')
                        ->get();
        foreach ($parJours as $key => $value) {
            $totalParJour[] = $value->accidentsAvec + $value->accidentsSans;
        }
        return view('HSE.BAT.showBilanSemestre')->with([
            'bilan' => $bilan,
            'parMois' => $parMois,
            'parJours' => $parJours,
            'totalParJour' => $totalParJour,
            'parHeur' => $parHeur,
            'parSieges' => $parSieges,
            'parAnciennete' => $parAnciennete,
            'parFonction' => $parFonction,
         ]);
    }

    public function showBilanSemestreA($t,$annee)
    {
        $bilanH = BilanSemestriel::where('annee',$annee)
                                    ->where('semestre',$t)
                                    ->where('unite',2)
                                    ->first();

        $bilanT = BilanSemestriel::where('annee',$annee)
                                    ->where('semestre',$t)
                                    ->where('unite',1)
                                    ->first(); 
        if ($bilanH) {
            foreach ($bilanH->bilanMensuel as $bilanMensuel) {
                $idsH[] = $bilanMensuel->id;
            }
            $parMoisH = DB::table('bilan_mensuels')
                                    ->select(DB::raw('sum(nbr_accidents) as accidents, sum(nbr_jours) as jours, mois'))
                                    ->orderBy('created_at')
                                    ->whereIn('id',$idsH)
                                    ->groupBy('mois')
                                    ->get();
            $parJoursH = DB::table('accident_par_jours')
                                    ->select(DB::raw('sum(avec_arret) as accidentsAvec, sum(sans_arret) as accidentsSans, jour'))
                                    ->orderBy('created_at')
                                    ->whereIn('bilan_id',$idsH)
                                    ->groupBy('jour')
                                    ->get();
            $parHeurH = DB::table('accident_par_heurs')
                                    ->select(DB::raw('sum(nbr_accidents) as accidents, heure'))
                                    ->orderBy('created_at')
                                    ->whereIn('bilan_id',$idsH)
                                    ->groupBy('heure')
                                    ->get();  
            $parSiegesH = DB::table('accident_par_sieges')
                                    ->select(DB::raw('sum(nbr_accidents) as accidents, siege_lesions'))
                                    ->orderBy('created_at')
                                    ->whereIn('bilan_id',$idsH)
                                    ->groupBy('siege_lesions')
                                    ->get(); 
            $parAncienneteH = DB::table('accident_par_anciennetes')
                                ->select(DB::raw('sum(nbr_accidents) as accidents, anciennete'))
                                ->orderBy('created_at')
                                ->whereIn('bilan_id',$idsH)
                                ->groupBy('anciennete')
                                ->get(); 
            $parFonctionH = DB::table('accident_par_fcts')
                            ->select(DB::raw('sum(nbr_accidents) as accidents, fonction'))
                            ->orderBy('created_at')
                            ->whereIn('bilan_id',$idsH)
                            ->groupBy('fonction')
                            ->get();
            foreach ($parJoursH as $key => $value) {
                $totalParJourH[] = $value->accidentsAvec + $value->accidentsSans;
            }
        }else{
            $parMoisH = null;
            $parJoursH = null;
            $totalParJourH = null;
            $parHeurH = null;
            $parSiegesH = null;
            $parAncienneteH = null;
            $parFonctionH = null;
        }
        if ($bilanT) {
            foreach ($bilanT->bilanMensuel as $bilanMensuel) {
                $idsT[] = $bilanMensuel->id;
            }
            $parMoisT = DB::table('bilan_mensuels')
                                    ->select(DB::raw('sum(nbr_accidents) as accidents, sum(nbr_jours) as jours, mois'))
                                    ->orderBy('created_at')
                                    ->whereIn('id',$idsT)
                                    ->groupBy('mois')
                                    ->get();
            $parJoursT = DB::table('accident_par_jours')
                                    ->select(DB::raw('sum(avec_arret) as accidentsAvec, sum(sans_arret) as accidentsSans, jour'))
                                    ->orderBy('created_at')
                                    ->whereIn('bilan_id',$idsT)
                                    ->groupBy('jour')
                                    ->get();
            $parHeurT = DB::table('accident_par_heurs')
                                    ->select(DB::raw('sum(nbr_accidents) as accidents, heure'))
                                    ->orderBy('created_at')
                                    ->whereIn('bilan_id',$idsT)
                                    ->groupBy('heure')
                                    ->get();  
            $parSiegesT = DB::table('accident_par_sieges')
                                    ->select(DB::raw('sum(nbr_accidents) as accidents, siege_lesions'))
                                    ->orderBy('created_at')
                                    ->whereIn('bilan_id',$idsT)
                                    ->groupBy('siege_lesions')
                                    ->get(); 
            $parAncienneteT = DB::table('accident_par_anciennetes')
                                ->select(DB::raw('sum(nbr_accidents) as accidents, anciennete'))
                                ->orderBy('created_at')
                                ->whereIn('bilan_id',$idsT)
                                ->groupBy('anciennete')
                                ->get(); 
            $parFonctionT = DB::table('accident_par_fcts')
                            ->select(DB::raw('sum(nbr_accidents) as accidents, fonction'))
                            ->orderBy('created_at')
                            ->whereIn('bilan_id',$idsT)
                            ->groupBy('fonction')
                            ->get();
            foreach ($parJoursT as $key => $value) {
                $totalParJourT[] = $value->accidentsAvec + $value->accidentsSans;
            }
        }else{
            $parMoisT = null;
            $parJoursT = null;
            $totalParJourT = null;
            $parHeurT = null;
            $parSiegesT = null;
            $parAncienneteT = null;
            $parFonctionT = null;
        }
        if ($bilanH && $bilanT) {
            $parMoisC = DB::table('bilan_mensuels')
                                    ->select(DB::raw('sum(nbr_accidents) as accidents, sum(nbr_jours) as jours, mois'))
                                    ->orderBy('created_at')
                                    ->whereIn('id',$idsT)
                                    ->orWhereIn('id',$idsH)
                                    ->groupBy('mois')
                                    ->get();
            $parJoursC = DB::table('accident_par_jours')
                                    ->select(DB::raw('sum(avec_arret) as accidentsAvec, sum(sans_arret) as accidentsSans, jour'))
                                    ->orderBy('created_at')
                                    ->whereIn('bilan_id',$idsT)
                                    ->orWhereIn('bilan_id',$idsH)
                                    ->groupBy('jour')
                                    ->get();
            
            $parHeurC = DB::table('accident_par_heurs')
                                    ->select(DB::raw('sum(nbr_accidents) as accidents, heure'))
                                    ->orderBy('created_at')
                                    ->whereIn('bilan_id',$idsT)
                                    ->orWhereIn('bilan_id',$idsH)
                                    ->groupBy('heure')
                                    ->get();  
            $parSiegesC = DB::table('accident_par_sieges')
                                    ->select(DB::raw('sum(nbr_accidents) as accidents, siege_lesions'))
                                    ->orderBy('created_at')
                                    ->whereIn('bilan_id',$idsT)
                                    ->orWhereIn('bilan_id',$idsH)
                                    ->groupBy('siege_lesions')
                                    ->get(); 
            $parAncienneteC = DB::table('accident_par_anciennetes')
                                ->select(DB::raw('sum(nbr_accidents) as accidents, anciennete'))
                                ->orderBy('created_at')
                                ->whereIn('bilan_id',$idsT)
                                ->orWhereIn('bilan_id',$idsH)
                                ->groupBy('anciennete')
                                ->get(); 
            $parFonctionC = DB::table('accident_par_fcts')
                            ->select(DB::raw('sum(nbr_accidents) as accidents, fonction'))
                            ->orderBy('created_at')
                            ->whereIn('bilan_id',$idsT)
                            ->orWhereIn('bilan_id',$idsH)
                            ->groupBy('fonction')
                            ->get();
            foreach ($parJoursC as $key => $value) {
                $totalParJourC[] = $value->accidentsAvec + $value->accidentsSans;
            }
        }else{
            $parMoisC = null;
            $parJoursC = null;
            $totalParJourC = null;
            $parHeurC = null;
            $parSiegesC = null;
            $parAncienneteC = null;
            $parFonctionC = null;
        }

        return view('HSE.BAT.showBilanSemestreAdmin')->with([
            'bilanH' => $bilanH,
            'parMoisH' => $parMoisH,
            'parJoursH' => $parJoursH,
            'totalParJourH' => $totalParJourH,
            'parHeurH' => $parHeurH,
            'parSiegesH' => $parSiegesH,
            'parAncienneteH' => $parAncienneteH,
            'parFonctionH' => $parFonctionH,
            'bilanT' => $bilanT,
            'parMoisT' => $parMoisT,
            'parJoursT' => $parJoursT,
            'totalParJourT' => $totalParJourT,
            'parHeurT' => $parHeurT,
            'parSiegesT' => $parSiegesT,
            'parAncienneteT' => $parAncienneteT,
            'parFonctionT' => $parFonctionT,
            'parMoisC' => $parMoisC,
            'parJoursC' => $parJoursC,
            'totalParJourC' => $totalParJourC,
            'parHeurC' => $parHeurC,
            'parSiegesC' => $parSiegesC,
            'parAncienneteC' => $parAncienneteC,
            'parFonctionC' => $parFonctionC,
            't' => $t,
            'annee' => $annee,
         ]);
    }
}
