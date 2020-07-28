<?php

namespace App\Http\Controllers;
use App;
use PDF;
use Response;
use App\BilanAnnuel;
use App\BilanMensuel;
use App\BilanSemestriel;
use App\BilanTrimestriel;
use App\DeclarationAccidentMateriel;
use App\DeclarationAccidentTravail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PdfController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function exportBilanMensuel($id)
    {   
        $bilan = BilanMensuel::find($id);
        $parJours = $bilan->accidentsParJour;
        foreach ($parJours as $key => $value) {
            $totalParJour[] = $value->avec_arret + $value->sans_arret;
        }
        $pdf = PDF::loadView('HSE.BAT.exportMensuel', array('bilan'=> $bilan , 'totalParJour' => $totalParJour) );
        return $pdf->stream();
    }

    public function exportConsolideMensuel($mois, $annee)
    {   

        $bilanTerga = BilanMensuel::where('annee',$annee)
                                ->where('mois',$mois)
                                ->where('unite',1)
                                ->first();
        $bilanHennaya = BilanMensuel::where('annee',$annee)
                                ->where('mois',$mois)
                                ->where('unite',2)
                                ->first();
        $consolideParJours = DB::table('accident_par_jours')
                                ->select(DB::raw('sum(avec_arret) as accidentsAvec, sum(sans_arret) as accidentsSans, jour'))
                                ->orderBy('created_at')
                                ->where('bilan_id',$bilanTerga->id)
                                ->orWhere('bilan_id',$bilanHennaya->id)
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
        if ($bilanHennaya && $bilanTerga) {
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
        $pdf = PDF::loadView('HSE.BAT.exportConsolideMensuel', array('annee'=> $annee,
                                                                    'mois'=> $mois,
                                                                    'totalParJour' => $totalParJour,
                                                                    'accidents_total' => $accidents_total,
                                                                    'jours_total' => $jours_total,
                                                                    'consolideParJours' => $consolideParJours,
                                                                    'consolideParHeur' => $consolideParHeur,
                                                                    'consolideParSiege' => $consolideParSiege,
                                                                    'consolideParAnc' => $consolideParAnc,
                                                                    'consolideParFct' => $consolideParFct,));
        return $pdf->stream();
    }

    public function exportBilanTrimestriel($id)
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
        $pdf = PDF::loadView('HSE.BAT.exportTrimestriel', array('bilan' => $bilan,
                                                            'parMois' => $parMois,
                                                            'parJours' => $parJours,
                                                            'totalParJour' => $totalParJour,
                                                            'parHeur' => $parHeur,
                                                            'parSieges' => $parSieges,
                                                            'parAnciennete' => $parAnciennete,
                                                            'parFonction' => $parFonction,) 
                                                        );
        return $pdf->stream();
    }

    public function exportConsolideTrimestriel($t,$annee)
    {  
        $bilanH = BilanTrimestriel::where('annee',$annee)
                                    ->where('trimestre',$t)
                                    ->where('unite',2)
                                    ->first();

        $bilanT = BilanTrimestriel::where('annee',$annee)
                                    ->where('trimestre',$t)
                                    ->where('unite',1)
                                    ->first();

        foreach ($bilanH->bilanMensuel as $bilanMensuel) {
                $idsH[] = $bilanMensuel->id;
        }
        foreach ($bilanT->bilanMensuel as $bilanMensuel) {
            $idsT[] = $bilanMensuel->id;
        } 
        
        $parMois = DB::table('bilan_mensuels')
                                ->select(DB::raw('sum(nbr_accidents) as accidents, sum(nbr_jours) as jours, mois'))
                                ->orderBy('created_at')
                                ->whereIn('id',$idsT)
                                ->orWhereIn('id',$idsH)
                                ->groupBy('mois')
                                ->get();
        $parJours = DB::table('accident_par_jours')
                                ->select(DB::raw('sum(avec_arret) as accidentsAvec, sum(sans_arret) as accidentsSans, jour'))
                                ->orderBy('created_at')
                                ->whereIn('bilan_id',$idsT)
                                ->orWhereIn('bilan_id',$idsH)
                                ->groupBy('jour')
                                ->get();
        
        $parHeur = DB::table('accident_par_heurs')
                                ->select(DB::raw('sum(nbr_accidents) as accidents, heure'))
                                ->orderBy('created_at')
                                ->whereIn('bilan_id',$idsT)
                                ->orWhereIn('bilan_id',$idsH)
                                ->groupBy('heure')
                                ->get();  
        $parSieges = DB::table('accident_par_sieges')
                                ->select(DB::raw('sum(nbr_accidents) as accidents, siege_lesions'))
                                ->orderBy('created_at')
                                ->whereIn('bilan_id',$idsT)
                                ->orWhereIn('bilan_id',$idsH)
                                ->groupBy('siege_lesions')
                                ->get(); 
        $parAnciennete = DB::table('accident_par_anciennetes')
                            ->select(DB::raw('sum(nbr_accidents) as accidents, anciennete'))
                            ->orderBy('created_at')
                            ->whereIn('bilan_id',$idsT)
                            ->orWhereIn('bilan_id',$idsH)
                            ->groupBy('anciennete')
                            ->get(); 
        $parFonction = DB::table('accident_par_fcts')
                        ->select(DB::raw('sum(nbr_accidents) as accidents, fonction'))
                        ->orderBy('created_at')
                        ->whereIn('bilan_id',$idsT)
                        ->orWhereIn('bilan_id',$idsH)
                        ->groupBy('fonction')
                        ->get();
        foreach ($parJours as $key => $value) {
            $totalParJour[] = $value->accidentsAvec + $value->accidentsSans;
        }
        $pdf = PDF::loadView('HSE.BAT.exportConsolideTrimestriel', array(
                                                            'parMois' => $parMois,
                                                            'parJours' => $parJours,
                                                            'totalParJour' => $totalParJour,
                                                            'parHeur' => $parHeur,
                                                            'parSieges' => $parSieges,
                                                            'parAnciennete' => $parAnciennete,
                                                            'parFonction' => $parFonction,
                                                            't' => $t,
                                                            'annee' => $annee,) 
                                                        );
        return $pdf->stream();
    }

    public function exportBilanSemestriel($id)
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
        $pdf = PDF::loadView('HSE.BAT.exportSemestriel', array('bilan' => $bilan,
                                                            'parMois' => $parMois,
                                                            'parJours' => $parJours,
                                                            'totalParJour' => $totalParJour,
                                                            'parHeur' => $parHeur,
                                                            'parSieges' => $parSieges,
                                                            'parAnciennete' => $parAnciennete,
                                                            'parFonction' => $parFonction,) 
                                                        );
        return $pdf->stream();
    }

    public function exportConsolideSemestriel($s,$annee)
    {  
        $bilanH = BilanSemestriel::where('annee',$annee)
                                    ->where('semestre',$s)
                                    ->where('unite',2)
                                    ->first();

        $bilanT = BilanSemestriel::where('annee',$annee)
                                    ->where('semestre',$s)
                                    ->where('unite',1)
                                    ->first();

        foreach ($bilanH->bilanMensuel as $bilanMensuel) {
                $idsH[] = $bilanMensuel->id;
        }
        foreach ($bilanT->bilanMensuel as $bilanMensuel) {
            $idsT[] = $bilanMensuel->id;
        } 
        
        $parMois = DB::table('bilan_mensuels')
                                ->select(DB::raw('sum(nbr_accidents) as accidents, sum(nbr_jours) as jours, mois'))
                                ->orderBy('created_at')
                                ->whereIn('id',$idsT)
                                ->orWhereIn('id',$idsH)
                                ->groupBy('mois')
                                ->get();
        $parJours = DB::table('accident_par_jours')
                                ->select(DB::raw('sum(avec_arret) as accidentsAvec, sum(sans_arret) as accidentsSans, jour'))
                                ->orderBy('created_at')
                                ->whereIn('bilan_id',$idsT)
                                ->orWhereIn('bilan_id',$idsH)
                                ->groupBy('jour')
                                ->get();
        
        $parHeur = DB::table('accident_par_heurs')
                                ->select(DB::raw('sum(nbr_accidents) as accidents, heure'))
                                ->orderBy('created_at')
                                ->whereIn('bilan_id',$idsT)
                                ->orWhereIn('bilan_id',$idsH)
                                ->groupBy('heure')
                                ->get();  
        $parSieges = DB::table('accident_par_sieges')
                                ->select(DB::raw('sum(nbr_accidents) as accidents, siege_lesions'))
                                ->orderBy('created_at')
                                ->whereIn('bilan_id',$idsT)
                                ->orWhereIn('bilan_id',$idsH)
                                ->groupBy('siege_lesions')
                                ->get(); 
        $parAnciennete = DB::table('accident_par_anciennetes')
                            ->select(DB::raw('sum(nbr_accidents) as accidents, anciennete'))
                            ->orderBy('created_at')
                            ->whereIn('bilan_id',$idsT)
                            ->orWhereIn('bilan_id',$idsH)
                            ->groupBy('anciennete')
                            ->get(); 
        $parFonction = DB::table('accident_par_fcts')
                        ->select(DB::raw('sum(nbr_accidents) as accidents, fonction'))
                        ->orderBy('created_at')
                        ->whereIn('bilan_id',$idsT)
                        ->orWhereIn('bilan_id',$idsH)
                        ->groupBy('fonction')
                        ->get();
        foreach ($parJours as $key => $value) {
            $totalParJour[] = $value->accidentsAvec + $value->accidentsSans;
        }
        $pdf = PDF::loadView('HSE.BAT.exportConsolideSemestriel', array(
                                                            'parMois' => $parMois,
                                                            'parJours' => $parJours,
                                                            'totalParJour' => $totalParJour,
                                                            'parHeur' => $parHeur,
                                                            'parSieges' => $parSieges,
                                                            'parAnciennete' => $parAnciennete,
                                                            'parFonction' => $parFonction,
                                                            's' => $s,
                                                            'annee' => $annee,) 
                                                        );
        return $pdf->stream();
    }

    public function exportBilanAnnuel($id)
    {   
        $bilan = BilanAnnuel::find($id);
        foreach($bilan->bilanMensuel as $bilanMensuel){
            $ids[] = $bilanMensuel->id;
        }
        
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
        $pdf = PDF::loadView('HSE.BAT.exportAnnuel', array('bilan'=> $bilan,
                                                            'parJours' => $parJours,
                                                            'totalParJour' => $totalParJour,
                                                            'parHeur' => $parHeur,
                                                            'parSieges' => $parSieges,
                                                            'parAnciennete' => $parAnciennete,
                                                            'parFonction' => $parFonction,
                                                            ) );
        return $pdf->stream();
    }
    public function exportConsolideAnnuel($annee)
    {   
        $bilans = BilanAnnuel::where('annee',$annee)->get();
        foreach ($bilans as $bilan) {
            foreach($bilan->bilanMensuel as $bilanMensuel){
                $ids[] = $bilanMensuel->id;
            }
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
        $pdf = PDF::loadView('HSE.BAT.exportConsolideAnnuel', array('bilan'=> $bilan,
                                                            'parJours' => $parJours,
                                                            'parMois' => $parMois,
                                                            'totalParJour' => $totalParJour,
                                                            'parHeur' => $parHeur,
                                                            'parSieges' => $parSieges,
                                                            'parAnciennete' => $parAnciennete,
                                                            'parFonction' => $parFonction,
                                                            'annee' => $annee,
                                                            ) );
        return $pdf->stream();
    }

    public function exportDeclarationM($id)
    {   
        $declaration = DeclarationAccidentMateriel::find($id);
        $pdf = PDF::loadView('HSE.DAM.exportDeclaration', array('declaration'=> $declaration) );
        return $pdf->stream();
    }
    public function exportDeclarationT($id)
    {   
        $declaration = DeclarationAccidentTravail::find($id);
        $pdf = PDF::loadView('HSE.DAT.exportDeclaration', array('declaration'=> $declaration) );
        return $pdf->stream();
    }
}