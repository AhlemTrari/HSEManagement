@extends('layouts.app')

@section('titre')
<title>Déclarations d'Accident de Travail | APMC Divindus</title>
@endsection

@section('links')

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
                <li>
                    <a href="{{url('/BilanAccidentT')}}">
                        <span>Bilan des accidents de travail</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('/BilanAccidentM')}}">
                        <span>Bilan des accidents de matériels</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('/MedcineDeTravail')}}" >
                        <span>Médecine de travail</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('/CommissionHygieneSecurite')}}">
                        <span>Commission d'unité Hygiène et Sécurité</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('/PlanHygieneSecurite')}}">
                        <span>Plan d'Hygiène et de Sécurité</span>
                    </a>
                </li>
                <li class="active">
                    <a href="{{url('/DeclarationAccidentT')}}">
                        <span>Déclarations des accidents de travail</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('/DeclarationAccidentM')}}">
                        <span>Déclarations des accidents de matériels</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('/InductionHSE')}}">
                        <span>Induction HSE</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('/MLCI')}}">
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
            <a href="{{url('/RapportActivite')}}">
                <i class="material-icons">insert_chart</i>
                <span>Rapport d'activité</span>
            </a>
        </li>
        <li>
            <a href="{{url('/Bibliotheque')}}">
                <i class="material-icons col-amber">donut_large</i>
                <span>Bibliothèque</span>
            </a>
        </li>
        <li>
            <a href="{{url('/Cartes')}}">
                <i class="material-icons col-light-blue">donut_large</i>
                <span>Cartes</span>
            </a>
        </li>
        <li>
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons col-red">donut_large</i>
                <span>S.M.HSE</span>
            </a>
            <ul class="ml-menu">
                <li>
                    <a  href="{{url('/S_M_HSE')}}">
                        <span>En cour d'utilisation</span>
                    </a>
                </li>
                <li>
                    <a  href="{{url('/S_M_HSE/archives')}}">
                        <span>Archives</span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</div>
@endsection

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row" style="margin-bottom: 25px">
            <div class="col-md-8 col-lg-8">
            </div>
            <div class="col-md-4 col-lg-4">
                <a href="{{url('/exportDeclarationTravail/'.$declaration->id)}}" type="button" target=”_blank” class="btn bg-teal btn-block btn-lg waves-effect">Exporter cette déclaration</a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            <center>
                                D.A.T &nbsp; n° {{$declaration->num}} &nbsp; créer le &nbsp; {{$declaration->created_at->format('d-m-Y')}}
                            </center>
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="card">
                <div class="header bg-blue-grey">
                    <center>
                    <h2>
                        Victime
                    </h2>
                    </center>
                </div>
                <div class="body">
                    <div class="row clearfix">
                        <div class="col-sm-offset-1 col-sm-5">
                                <strong>Matricule : &nbsp;</strong>
                                <span> {{$declaration->victime->matricule}}</span>
                        </div>
                        <div class="col-sm-5">
                                <strong>Qualification professionnelle : &nbsp;</strong>
                                <span> {{$declaration->victime->fonction}}</span>
                        </div>
                        <div class="col-sm-offset-1 col-sm-5">
                                <strong>Nom : &nbsp;</strong>
                                <span> {{$declaration->victime->nom}}</span>
                        </div>
                        <div class=" col-sm-5">
                                <strong>Prénom : &nbsp;</strong>
                                <span> {{$declaration->victime->prenom}}</span>
                        </div>
                        <div class="col-sm-offset-1 col-sm-5">
                            <p>
                                <strong>Date de naissance : &nbsp;</strong>
                                <span> {{$declaration->victime->date_naissance}}</span>
                            </p>
                        </div>
                        <div class="col-sm-5">
                            <p>
                                <strong>Date de recrutement : &nbsp;</strong>
                                <span> {{$declaration->victime->date_recrutement}}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="card">
                <div class="header bg-light-green"> 
                    <!-- bg-light-blue -->
                    <center>
                    <h2>
                        Accident
                    </h2>
                    </center>
                </div>
                
                <div class="body">
                    <div class="row clearfix">
                        <div class="col-sm-offset-1 col-sm-4">
                            <strong>L’accident à t-il fait d’autres victimes ? &nbsp;</strong>
                        </div>
                        <div class="col-sm-6">
                            @if ($declaration->autre_victimes)
                            <span>Oui</span>
                            @else
                            <span>Non</span>
                            @endif
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-sm-offset-1 col-sm-4">
                            <strong>Lieu exact de l’accident : &nbsp;</strong>
                        </div>
                        <div class="col-sm-6">
                            <span>{{$declaration->lieu}}</span>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-sm-offset-1 col-sm-4">
                            <strong>Site (chantier): &nbsp;</strong>
                        </div>
                        <div class="col-sm-6">
                            <span>{{$declaration->chantier}}</span>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-sm-offset-1 col-sm-4">
                            <strong>Date : &nbsp;</strong>
                        </div>
                        <div class="col-sm-6">
                            <span>{{$declaration->date}} &nbsp;</span>
                            
                            <strong>à : &nbsp;</strong>
                            <span>{{$declaration->heure}}</span>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-sm-offset-1 col-sm-4">
                            <strong>Que faisait la victime au moment de l’accident? &nbsp;</strong>
                        </div>
                        <div class="col-sm-6">
                            <span>{{$declaration->travail_courrant}}</span>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-sm-offset-1 col-sm-4">
                            <strong>Nature des lésions : &nbsp;</strong>
                        </div>
                        <div class="col-sm-6">
                            <span>{{$declaration->nature_lesion}}</span>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-sm-offset-1 col-sm-4">
                            <strong>Siège des lésions : &nbsp;</strong>
                        </div>
                        <div class="col-sm-6">
                            <span>{{$declaration->siege_lesion}}</span>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-sm-offset-1 col-sm-4">
                            <strong>Eléments matériels à l’origine de l’accident : &nbsp;</strong>
                        </div>
                        <div class="col-sm-6">
                            <span>{{$declaration->materiel}}</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        
        <div class="row">
            <div class="card">
                <div class="header bg-blue-grey"> 
                    <!-- bg-light-blue -->
                    <center>
                    <h2>
                        Causes de l'accident
                    </h2>
                    </center>
                </div>
                <div class="body">
                    <div class="row">
                        <div class="row clearfix">
                            <div class="col-sm-offset-1 col-sm-4">
                                <strong>Causes directes : &nbsp;</strong>
                            </div>
                            <div class="col-sm-6">
                                <span>{{$declaration->cause_direct}}</span>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-offset-1 col-sm-4">
                                <strong>Causes indirectes : &nbsp;</strong>
                            </div>
                            <div class="col-sm-6">
                                <span>{{$declaration->cause_indirect}}</span>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-offset-1 col-sm-4">
                                <strong>Conséquences : &nbsp;</strong>
                            </div>
                            <div class="col-sm-6">
                                <span>{{$declaration->consequences}}
                                    @if ($declaration->nbr_arret)
                                        ({{$declaration->nbr_arret}} Jours)
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-offset-1 col-sm-4">
                                <strong>Victime transporté à : &nbsp;</strong>
                            </div>
                            <div class="col-sm-6">
                                <span>{{$declaration->transporter_a}}</span>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-offset-1 col-sm-4">
                                <strong>Par quel moyen ? &nbsp;</strong>
                            </div>
                            <div class="col-sm-6">
                                <span>{{$declaration->moyen_par}}</span>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-offset-1 col-sm-4">
                                <strong>L’accident a-t-il été causé par un tiers ? &nbsp;</strong>
                            </div>
                            <div class="col-sm-6">
                                @if ($declaration->tiers_id)
                                <span>Oui</span>
                                @else
                                <span>Non</span>
                                @endif
                            </div>
                        </div>
                        @if ($declaration->tiers_id)
                            <div class="row clearfix">
                                <div class="col-sm-offset-4 col-sm-6">
                                <p> <h4> Coordonnées du tiers </h4></p>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-offset-1 col-sm-5">
                                    <strong>Nom : &nbsp;</strong>
                                    <span>{{$declaration->tiers->nom}}</span>
                                </div>
                                <div class="col-sm-5">
                                    <strong>Prénom : &nbsp;</strong>
                                    <span>{{$declaration->tiers->prenom}}</span>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-offset-1 col-sm-5">
                                    <strong>Date de recrutement : &nbsp;</strong>
                                    <span>{{$declaration->tiers->date_recrutement}}</span>
                                </div>
                                <div class="col-sm-5">
                                    <strong>Qualification professionnelle : &nbsp;</strong>
                                    <span>{{$declaration->tiers->fonction}}</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="card">
                <div class="header bg-light-green">
                    <center>
                    <h2>
                        Témoins
                    </h2>
                    </center>
                </div>
                <div class="body">
                    <div class="row clearfix">
                        <div class="col-sm-offset-1 col-sm-4">
                            <strong>Nom et prénom des témoins &nbsp;</strong>
                        </div>
                        <div class="col-sm-6">
                            <span>{{$declaration->temoins}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="card">
                <div class="header bg-blue-grey">
                    <center>
                    <h2>
                        Circonstances détaillées de l’accident
                    </h2>
                    </center>
                </div>
                <div class="body">
                    <div class="row clearfix">
                        <div class="col-sm-offset-1 col-sm-10">
                        <span>{{$declaration->circonstances_detaillees}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <br/><br/>
        </div>
    </div>
</section>
@endsection
