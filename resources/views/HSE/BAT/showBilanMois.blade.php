@extends('layouts.app')

@section('titre')
<title>Bilan des accidents de travail | APMC Divindus</title>
@endsection

@section('menu')
<div class="menu">
    <ul class="list">
        <li class="header">MENU</li>
        <li>
            <a href="{{url('home')}}">
                <i class="material-icons">home</i>
                <span>Acceuil</span>
            </a>
        </li>
        <li>
            <a href="{{url('employes')}}">
                <i class="material-icons">person</i>
                <span>Employés</span>
            </a>
        </li>
        <li  class="active">
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons">security</i>
                <span>HSE</span>
            </a>
            <ul class="ml-menu">
                <li  class="active">
                    <a href="{{url('BilanAccidentT')}}">
                        <span>Bilan des accidents de travail</span>
                    </a>
                </li>
                <li>
                    <a href="HSE/BAM/index.html">
                        <span>Bilan A.M</span>
                    </a>
                </li>
                <li>
                    <a href="HSE/MT/index.html" >
                        <span>Médecine de travail</span>
                    </a>
                </li>
                <li>
                    <a href="HSE/CHS/index.html">
                        <span>Commission d'unité Hygiène et Sécurité</span>
                    </a>
                </li>
                <li>
                    <a href="HSE/PHS/index.html">
                        <span>Plan d'Hygiène et de Sécurité</span>
                    </a>
                </li>
                <li>
                    <a href="HSE/DAT/index.html">
                        <span>D.A.T</span>
                    </a>
                </li>
                <li>
                    <a href="HSE/DAM/index.html">
                        <span>D.A.M</span>
                    </a>
                </li>
                <li>
                    <a href="HSE/IHSE/index.html">
                        <span>Induction HSE</span>
                    </a>
                </li>
                <li>
                    <a href="HSE/MLCI/index.html">
                        <span>MLCI</span>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons">business_center</i>
                <span>SIE</span>
            </a>
            <ul class="ml-menu">
               
                <li>
                    <a href="pages/ui/notifications.html"></a>
                </li>
                
            </ul>
        </li>
        <li>
            <a href="biblio.html">
                <i class="material-icons col-amber">donut_large</i>
                <span>Bibliothèque</span>
            </a>
        </li>
        <li>
            <a href="cartes.html">
                <i class="material-icons col-light-blue">donut_large</i>
                <span>Cartes</span>
            </a>
        </li>
        <li>
            <a href="SMHSE/index.html">
                <i class="material-icons col-red">donut_large</i>
                <span>S.M.HSE</span>
            </a>
        </li>
    </ul>
</div>
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                
                <div class="row clearfix demo-button-sizes">
                    <div class="col-md-2">
                        <button type="button" class="btn bg-teal btn-block btn-lg waves-effect">Exporter en pdf </button>
                    </div>
                </div>

            </div>
            <div class="block-header">
                <h2>
                    BILAN DES ACCIDENTS DE TRAVAIL DU MOIs DE " "
                </h2>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <p>Nombre des accidents de travail : </p>
                                </div>
                                <div class="col-sm-6">
                                    <p>Nombre des journées perdues :</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Répartition des accidents de travail selon les jours de la semaine :
                            </h2>
                        </div>
                        <div class="body">
                            <table id="" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Jours</th>
                                        <th>Dim</th>
                                        <th>Lun</th>
                                        <th>Mar</th>
                                        <th>Merc</th>
                                        <th>Jeu</th>
                                        <th>Vend</th>
                                        <th>Sam</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Nbr d'accident sans arrêt</td>
                                        <td >0</td>
                                        <td >0</td>
                                        <td >0</td>
                                        <td >0</td>
                                        <td >0</td>
                                        <td >0</td>
                                        <td >0</td>
                                    </tr>
                                    <tr>
                                        <td>Nbr journées perdues</td>
                                        <td >0</td>
                                        <td >0</td>
                                        <td >0</td>
                                        <td >0</td>
                                        <td >0</td>
                                        <td >0</td>
                                        <td >0</td>
                                    </tr>
                                    <tr>
                                        <td>Total</td>
                                        <td >0</td>
                                        <td >0</td>
                                        <td >0</td>
                                        <td >0</td>
                                        <td >0</td>
                                        <td >0</td>
                                        <td >0</td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Répartition des accidents de travail par tranche d'horaires :
                            </h2>
                        </div>
                        <div class="body">
                            <table id="" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Tranches d'horaires</th>
                                        <th>Nbr d'accidents</th>
                                        <th>Pourcentage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>6h à 8h</td>
                                        <td >0</td>
                                        <td> %</td>
                                    </tr>
                                    <tr>
                                        <td>8h à 10h</td>
                                        <td >0</td>
                                        <td>%</td>
                                    </tr>
                                    <tr>
                                        <td>10h à 12h</td>
                                        <td >0</td>
                                        <td>%</td>
                                    </tr>
                                    <tr>
                                        <td>12h à 13h</td>
                                        <td >0</td>
                                        <td>%</td>
                                    </tr>
                                    <tr>
                                        <td>13h à 15h</td>
                                        <td >0</td>
                                        <td>%</td>
                                    </tr>
                                    <tr>
                                        <td>15h à 17h</td>
                                        <td >0</td>
                                        <td>%</td>
                                    </tr>
                                    <tr>
                                        <td>Autre</td>
                                        <td >0</td>
                                        <td>%</td>
                                    </tr>
                                    <tr>
                                        <td>Total</td>
                                        <td >125</td>
                                        <td > %</td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Répartition des accidents de travail par siège des lésions :
                            </h2>
                        </div>
                        <div class="body">
                            <table id="" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Siège des lésions</th>
                                        <th>Nbr d'accidents</th>
                                        <th>Pourcentage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Yeux</td>
                                        <td >0</td>
                                        <td> %</td>
                                    </tr>
                                    <tr>
                                        <td>Figure</td>
                                        <td >0</td>
                                        <td> %</td>
                                    </tr>
                                    <tr>
                                        <td>Tête</td>
                                        <td >0</td>
                                        <td> %</td>
                                    </tr>
                                    <tr>
                                        <td>Bassin</td>
                                        <td >0</td>
                                        <td> %</td>
                                    </tr>
                                    <tr>
                                        <td>Membres inférieurs</td>
                                        <td >0</td>
                                        <td> %</td>
                                    </tr>
                                    <tr>
                                        <td>Membres supérieurs</td>
                                        <td >0</td>
                                        <td> %</td>
                                    </tr>
                                    <tr>
                                        <td>Pieds</td>
                                        <td >0</td>
                                        <td> %</td>
                                    </tr>
                                    <tr>
                                        <td>Mains</td>
                                        <td >0</td>
                                        <td> %</td>
                                    </tr>
                                    <tr>
                                        <td>Doigts</td>
                                        <td >0</td>
                                        <td> %</td>
                                    </tr>
                                    <tr>
                                        <td>Thorax/ Lombaire</td>
                                        <td >0</td>
                                        <td> %</td>
                                    </tr>
                                    <tr>
                                        <td>Total</td>
                                        <td >158</td>
                                        <td > %</td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Répartition des accidents de travail selon l'ancienneté :
                            </h2>
                        </div>
                        <div class="body">
                            <table id="" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Ancienneté</th>
                                        <th>Nbr d'accidents</th>
                                        <th>Pourcentage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1 sem à 1 mois</td>
                                        <td >0</td>
                                        <td> %</td>
                                    </tr>
                                    <tr>
                                        <td>1 mois à 3 mois</td>
                                        <td >0</td>
                                        <td> %</td>
                                    </tr>
                                    <tr>
                                        <td>3 mois à 6 mois</td>
                                        <td >0</td>
                                        <td> %</td>
                                    </tr>
                                    <tr>
                                        <td>6 mois à 1 an</td>
                                        <td >0</td>
                                        <td> %</td>
                                    </tr>
                                    <tr>
                                        <td>1 an à 5 ans</td>
                                        <td >0</td>
                                        <td> %</td>
                                    </tr>
                                    <tr>
                                        <td>5 ans et plus</td>
                                        <td >0</td>
                                        <td> %</td>
                                    </tr>
                                    <tr>
                                        <td>Total</td>
                                        <td >425</td>
                                        <td > %</td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Répartition des accidents de travail par fonction :
                            </h2>
                        </div>
                        <div class="body">
                            <table id="" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Fonctions</th>
                                        <th>Nbr d'accidents</th>
                                        <th>Pourcentage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <tr>
                                        <td>Fonction 1</td>
                                        <td>0</td>
                                        <td> %</td>
                                   </tr> 
                                   <tr>
                                        <td>Apprentis et stagiaires</td>
                                        <td>0</td>
                                        <td> %</td>
                                   </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td>Total</td>
                                        <td >00</td>
                                        <td > %</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
