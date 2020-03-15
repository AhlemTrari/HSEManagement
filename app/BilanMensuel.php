<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BilanMensuel extends Model
{
    public function AccidentParJour()
    {
        return $this->hasOne('App\AccidentParJour');
    }
    public function AccidentParHeur()
    {
        return $this->hasOne('App\AccidentParHeur');
    }
    public function AccidentParSiege()
    {
        return $this->hasOne('App\AccidentParSiege');
    }
    public function AccidentParAnciennete()
    {
        return $this->hasOne('App\AccidentParAnciennete');
    }
    public function AccidentParFct()
    {
        return $this->hasOne('App\AccidentParFct');
    }

}
