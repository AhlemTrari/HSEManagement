<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BilanSemestriel extends Model
{
    public function bilanMensuel()
    {
        return $this->hasMany('App\BilanMensuel');
    }
}
