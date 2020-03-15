<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    protected $fillable = ['matricule', 'nom', 'prenom','unite', 'fonction','date_naissance' ,'date_rec','tel' ,'adresse'];
}
