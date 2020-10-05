<?php

namespace App\Exports;

use App\MedcineTravail;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class MedcineTravailMensuelExportView implements FromView
{
    protected $year;
    protected $mois;

    function __construct($mois,$year) {
            $this->year = $year;
            $this->mois = $mois;
    }

    public function view(): View
    {
        if (Auth::user()->is_admin) {
            $canevasExport = MedcineTravail::where(DB::raw('YEAR(visite_periodique)'),$this->year)
                                            ->where(DB::raw('MONTH(visite_periodique)'),$this->mois)->get();
        }else {
            $canevasExport = MedcineTravail::where(DB::raw('YEAR(visite_periodique)'),$this->year)
                                            ->where(DB::raw('MONTH(visite_periodique)'),$this->mois)
                                            ->where('unite',Auth::user()->unite)->get();
        }
        return view('HSE.MT.table', [
            'canevasExport' => $canevasExport 
        ]);
    }
}
