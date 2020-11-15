@extends('layouts.app')

@section('titre')
<title>Bilan des accidents de travail | APMC Divindus</title>
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
                <li class="active">
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
                    <a href="javascript:void(0);" class="menu-toggle">
                        <span>Médecine de travail</span>
                    </a>
                    <ul class="ml-menu">
                        <li >
                            <a href="{{url('/MedcineDeTravail')}}" >
                                <span>Canevas de médecine de travail</span>
                            </a>
                        </li>
                        <li >
                            <a href="{{url('/AmenagementPost')}}" >
                                <span>Aménagements du poste</span>
                            </a>
                        </li>
                    </ul>
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
                <li>
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
        <div class="block-header">
            
            <div class="row clearfix demo-button-sizes">
                
                <div class="col-md-8"></div>
                <div class="col-md-4 clearfix demo-button-sizes" style="float: right">
                    <a href="{{url('/exportBilanSemestriel/'.$bilan->id)}}" type="button" target="_blank" class="btn bg-teal btn-block btn-lg waves-effect">
                        Exporter en pdf 
                    </a>
                </div>
            </div>
        </div>
        <div class="block-header">
            <h2>
                BILAN DES ACCIDENTS DE TRAVAIL DU SEMESTRE " {{$bilan->semestre}} {{$bilan->annee}} "
            </h2>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Répartition des accidents de travail par moi :
                        </h2>
                    </div>
                    <div class="body">
                        <table id="" class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center"><strong>Mois</strong></th>
                                    @foreach ($parMois as $bilanMensuel)
                                        <th class="text-center"> {{$bilanMensuel->mois}}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center"><strong>Nbr d'accident de travail</strong></td>
                                    @foreach ($parMois as $bilanMensuel)
                                        <td class="text-center"> {{$bilanMensuel->accidents}}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <td class="text-center"><strong>Nbr de journées perdues</strong></td>
                                    @foreach ($parMois as $bilanMensuel)
                                        <td class="text-center"> {{$bilanMensuel->jours}}</td>
                                    @endforeach
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
                            Répartition des accidents de travail selon les jours de la semaine :
                        </h2>
                    </div>
                    <div class="body">
                        <table id="" class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center"><strong>Jours</strong></th>
                                    @foreach ($parJours as $accidentsParJour)
                                        <th class="text-center"> {{$accidentsParJour->jour}}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center"><strong>Nbr d'accident sans arrêt</strong></td>
                                    @foreach ($parJours as $accidentsParJour)
                                        <td class="text-center">{{$accidentsParJour->accidentsSans}}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <td class="text-center"><strong>Nbr d'accident avec arrêt</strong></td>
                                    @foreach ($parJours as $accidentsParJour)
                                        <td class="text-center">{{$accidentsParJour->accidentsAvec}}</td>
                                    @endforeach
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>    
                                    <th class="text-center"><strong>Total</strong></th>
                                    @foreach ($totalParJour as $total)
                                        <th class="text-center">{{$total}}</th>
                                    @endforeach
                                </tr>
                            </tfoot>
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
                                    <th class="text-center">Tranches d'horaires</th>
                                    <th class="text-center">Nbr d'accidents</th>
                                    <th class="text-center">Pourcentage</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($parHeur as $parHeure)
                                <tr>
                                    <td class="text-center"><strong> {{$parHeure->heure}}</strong></td>
                                    <td class="text-center">{{$parHeure->accidents}}</td>
                                    <td class="text-center">
                                        @php
                                            $pourcentage = $parHeure->accidents * 100 / $parHeur->sum('accidents')
                                        @endphp
                                        {{$pourcentage}} %
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>    
                                    <th class="text-center"><strong>Total</strong></th>
                                    <th class="text-center">{{$parHeur->sum('accidents')}}</th>
                                    <th class="text-center">100 %</th>
                                </tr>
                            </tfoot>
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
                                    <th class="text-center">Siège des lésions</th>
                                    <th class="text-center">Nbr d'accidents</th>
                                    <th class="text-center">Pourcentage</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($parSieges as $parSiege)
                                <tr>
                                    <td class="text-center"><strong> {{$parSiege->siege_lesions}}</strong></td>
                                    <td class="text-center">{{$parSiege->accidents}}</td>
                                    <td class="text-center">
                                        @php
                                            $pourcentage = $parSiege->accidents * 100 / $parSieges->sum('accidents')
                                        @endphp
                                        {{$pourcentage}} %
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>    
                                    <th class="text-center"><strong>Total</strong></th>
                                    <th class="text-center">{{$parSieges->sum('accidents')}}</th>
                                    <th class="text-center">100 %</th>
                                </tr>
                            </tfoot>
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
                                    <th class="text-center">Ancienneté</th>
                                    <th class="text-center">Nbr d'accidents</th>
                                    <th class="text-center">Pourcentage</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($parAnciennete as $parAnc)
                                <tr>
                                    <td class="text-center"><strong> {{$parAnc->anciennete}}</strong></td>
                                    <td class="text-center">{{$parAnc->accidents}}</td>
                                    <td class="text-center">
                                        @php
                                            $pourcentage = $parAnc->accidents * 100 / $parAnciennete->sum('accidents')
                                        @endphp
                                        {{$pourcentage}} %
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>    
                                    <th class="text-center"><strong>Total</strong></th>
                                    <th class="text-center">{{$parAnciennete->sum('accidents')}}</th>
                                    <th class="text-center">100 %</th>
                                </tr>
                            </tfoot>
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
                                    <th class="text-center">Fonctions</th>
                                    <th class="text-center">Nbr d'accidents</th>
                                    <th class="text-center">Pourcentage</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($parFonction as $parFct)
                                <tr>
                                    <td class="text-center"><strong> {{$parFct->fonction}}</strong></td>
                                    <td class="text-center">{{$parFct->accidents}}</td>
                                    <td class="text-center">
                                        @php
                                            $pourcentage = $parFct->accidents * 100 / $parFonction->sum('accidents')
                                        @endphp
                                        {{$pourcentage}} %
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>    
                                    <th class="text-center"><strong>Total</strong></th>
                                    <th class="text-center">{{$parFonction->sum('accidents')}}</th>
                                    <th class="text-center">100 %</th>
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

@section('scripts')

@endsection