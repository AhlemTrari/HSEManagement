<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Amenagement extends Model
{
    public function employe()
	{
	    return $this->belongsTo('App\Employe','employe_id');
    }
}
