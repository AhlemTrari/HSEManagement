<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Biblio extends Model
{
    public function emplacement()
    {
        return $this->belongsTo('App\BiblioEmplacement','emplacement_id');
    }
}
