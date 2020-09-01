<?php

namespace App\Exports;

use App\Employe;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class EmployesExport implements FromView
{
    public function view(): View
    {
        if (Auth::user()->is_admin) {
            $employes = Employe::all();
        }else {
            $employes = Employe::where('unite',Auth::user()->unite)->get();
        }
        return view('employe.table', [
            'employes' => $employes 
        ]);
    }
}
