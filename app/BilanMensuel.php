<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BilanMensuel extends Model
{
    public function accidentsParJour()
    {
        return $this->hasMany('App\AccidentParJour', 'bilan_id');
    }
    public function accidentParHeure()
    {
        return $this->hasMany('App\AccidentParHeur', 'bilan_id');
    }
    public function accidentParSiege()
    {
        return $this->hasMany('App\AccidentParSiege', 'bilan_id');
    }
    public function accidentParAnciennete()
    {
        return $this->hasMany('App\AccidentParAnciennete', 'bilan_id');
    }
    public function accidentParFct()
    {
        return $this->hasMany('App\AccidentParFct', 'bilan_id');
    }
    public function bilanAnuel()
	{
	    return $this->belongsTo('App\BilanAnnuel');
    }
    public function bilanTrimestriel()
	{
	    return $this->belongsTo('App\BilanTrimestriel');
    }
    public function bilanSemetriel()
	{
	    return $this->belongsTo('App\BilanSemestriel');
	}

}
