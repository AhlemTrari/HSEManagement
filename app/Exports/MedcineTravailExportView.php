<?php

namespace App\Exports;

use App\MedcineTravail;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class MedcineTravailExportView implements FromView
{
    protected $year;

    function __construct($year) {
            $this->year = $year;
    }

    public function view(): View
    {
        if (Auth::user()->is_admin) {
            $canevasExport = MedcineTravail::where(DB::raw('YEAR(visite_periodique)'),$this->year)->get();
        }else {
            $canevasExport = MedcineTravail::where(DB::raw('YEAR(visite_periodique)'),$this->year)
                                            ->where('unite',Auth::user()->unite)->get();
        }
        return view('HSE.MT.table', [
            'canevasExport' => $canevasExport 
        ]);
    }
}
