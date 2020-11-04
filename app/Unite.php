<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unite extends Model
{
    public function bilans()
    {
        return $this->hasMany('App\BilanMensuel','unite_id');
    }
    public function users()
    {
        return $this->hasMany('App\User','unite_id');
    }
    public function employes()
    {
        return $this->hasMany('App\Employe','unite_id');
    }
    public function declarationsAM()
    {
        return $this->hasMany('App\DeclarationAccidentMateriel','unite_id');
    }
    public function declarationsAT()
    {
        return $this->hasMany('App\DeclarationAccidentTravail','unite_id');
    }
    public function commissions()
    {
        return $this->hasMany('App\Commission','unite_id');
    }
    public function plans()
    {
        return $this->hasMany('App\PlanHygiene','unite_id');
    }
}
