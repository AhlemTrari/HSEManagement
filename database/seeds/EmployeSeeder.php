<?php

use App\Employe;
use Illuminate\Database\Seeder;

class EmployeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employe1 = new Employe();
	    $employe1->matricule = '098769';
	    $employe1->nom = 'Trari Bouchra';
	    $employe1->fonction = 'Secretaire De Direct';
	    $employe1->unite = 2;
	    $employe1->statut = 'statut1';
	    $employe1->date_naissance = '1996-01-21';
	    $employe1->date_rec = '2020-11-04';
	    $employe1->sexe = 'Femme';
	    $employe1->affectation = 'affectation1';
	    $employe1->visite_embauche = 'Non';
	    $employe1->poste_risque = 'Non';
        $employe1->save();

        $employe2 = new Employe();
	    $employe2->matricule = '098712';
	    $employe2->nom = 'Triki Moh';
	    $employe2->fonction = 'Chef departement';
	    $employe2->unite = 2;
	    $employe2->statut = 'statut1';
	    $employe2->date_naissance = '1986-05-01';
	    $employe2->date_rec = '2019-10-01';
	    $employe2->sexe = 'Homme';
	    $employe2->affectation = 'affectation1';
	    $employe2->visite_embauche = 'Oui';
	    $employe2->poste_risque = 'Non';
	    $employe2->save();
    }
}
