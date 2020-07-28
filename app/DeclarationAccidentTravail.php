<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeclarationAccidentTravail extends Model
{
    public function victime()
	{
	    return $this->belongsTo('App\Employe','employe_id');
    }
    public function tiers()
	{
	    return $this->belongsTo('App\Employe','tiers_id');
    }
}
