<?php

namespace App\Exports;

use App\MedcineTravail;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class MedcineTravailSemestrielExportView implements FromView
{
    protected $year;
    protected $s;

    function __construct($s,$year) {
            $this->year = $year;
            $this->s = $s;
    }

    public function view(): View
    {
        if (Auth::user()->is_admin) {
            $canevasExport = MedcineTravail::where(DB::raw('YEAR(visite_periodique)'),$this->year)
                                            ->where('semestre',$this->s)->get();
        }else {
            $canevasExport = MedcineTravail::where(DB::raw('YEAR(visite_periodique)'),$this->year)
                                            ->where('semestre',$this->s)
                                            ->where('unite',Auth::user()->unite)->get();
        }
        return view('HSE.MT.table', [
            'canevasExport' => $canevasExport 
        ]);
    }
}
