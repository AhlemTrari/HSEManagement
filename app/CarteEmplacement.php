<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarteEmplacement extends Model
{
    protected $fillable = ['intitule'];

    public function cartes()
    {
        return $this->hasMany('App\Carte','emplacement_id');
    }
}
