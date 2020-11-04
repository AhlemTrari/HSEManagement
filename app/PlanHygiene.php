<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanHygiene extends Model
{
    public function unite()
	{
	    return $this->belongsTo('App\Unite');
	}
}
