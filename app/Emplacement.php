<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Emplacement extends Model
{
    public function cartes()
    {
        return $this->hasMany('App\Carte','emplacement_id');
    }
}
