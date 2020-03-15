<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccidentParSiege extends Model
{
    public function BilanMensuel()
	{
	    return $this->belongsTo('App\BilanMensuel', 'bilan_id');
	}
}
