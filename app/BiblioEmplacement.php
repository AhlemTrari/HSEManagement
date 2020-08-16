<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BiblioEmplacement extends Model
{
    protected $fillable = ['intitule'];

    public function biblios()
    {
        return $this->hasMany('App\Biblio','emplacement_id');
    }
}
