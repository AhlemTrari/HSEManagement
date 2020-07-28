<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedcineTravail extends Model
{
    public function victime()
	{
	    return $this->belongsTo('App\Employe','employe_id');
    }
}
