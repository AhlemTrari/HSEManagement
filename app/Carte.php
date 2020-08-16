<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carte extends Model
{
    public function emplacement()
    {
        return $this->belongsTo('App\CarteEmplacement','emplacement_id');
    }
}
