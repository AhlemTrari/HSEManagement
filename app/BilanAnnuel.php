<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BilanAnnuel extends Model
{
    public function bilanMensuel()
    {
        return $this->hasMany('App\BilanMensuel');
    }
    public function bilanTrimestriel()
    {
        return $this->hasMany('App\BilanTrimestriel');
    }
    public function bilanSemestriel()
    {
        return $this->hasMany('App\BilanSemestriel');
    }
}
