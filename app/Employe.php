<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    protected $fillable = ['matricule', 'nom','unite', 'fonction','date_naissance' ,'date_rec','statut' ,'sexe','affectation','visite_embauche' ,'poste_risque'];

    public function declarations()
    {
        return $this->hasMany('App\DeclarationAccidentTravail','employe_id');
    }
    public function declarations_tiers()
    {
        return $this->hasMany('App\DeclarationAccidentTravail','tiers_id');
    }
    public function declarationsAM()
    {
        return $this->hasMany('App\DeclarationAccidentMateriel','employe_id');
    }
    public function canevas()
    {
        return $this->hasMany('App\MedcineTravail','employe_id');
    }
    public function inductions()
    {
        return $this->hasMany('App\Induction','employe_id');
    }
    public function amenagements()
    {
        return $this->hasMany('App\Amenagement','employe_id');
    }
    public function unitee()
	{
	    return $this->belongsTo('App\Unite','unite_id');
	}
}
