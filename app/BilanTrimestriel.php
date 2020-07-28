<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BilanTrimestriel extends Model
{
    public function bilanMensuel()
    {
        return $this->hasMany('App\BilanMensuel');
    }
}
