<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    
    public function unite()
	{
	    return $this->belongsTo('App\Unite');
	}
}
