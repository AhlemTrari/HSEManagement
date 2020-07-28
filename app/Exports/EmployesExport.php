<?php

namespace App\Exports;

use App\Employe;
use Maatwebsite\Excel\Concerns\FromCollection;

class EmployesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Employe::all();
    }
}
