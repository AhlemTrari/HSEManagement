<?php

namespace App\Imports;

use App\Employe;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class EmployeImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Employe([
           'matricule'=> $row[0],
           'nom'=> $row[1], 
           'fonction' => $row[2],
           'statut' => $row[3],
           'date_naissance' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[4])->format('d-m-y'),
           'date_rec' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[5])->format('d-m-y'),
           'sexe' => $row[6],
           'affectation' => $row[7], 
           'visite_embauche' => $row[8], 
           'poste_risque' => $row[9], 
           'unite' => Auth::user()->unite,
        ]);
    }
    
}
