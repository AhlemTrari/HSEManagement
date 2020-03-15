<?php

namespace App\Imports;

use App\Employe;
use Maatwebsite\Excel\Concerns\ToModel;

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
           'prenom' => $row[2],
           'fonction' => $row[3],
           'unite' => $row[4],
           'date_naissance' => $row[5],
           'date_rec' => $row[6],
           'tel' => $row[7],
           'adresse' => $row[8],
        ]);
    }
}
