<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeclarationAccidentMateriel extends Model
{
    public function responsable()
	{
	    return $this->belongsTo('App\Employe','employe_id');
    }
}
