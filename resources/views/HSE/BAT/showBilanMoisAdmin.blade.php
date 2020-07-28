@extends('layouts.dash')

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
            <a href="{{url('/S_M_HSE')}}">
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
                <div class="row">
                    <div class="col-md-8">
                        
                    </div>
                    <div class="col-md-4 clearfix demo-button-sizes" style="float: right">
                        <a href="#" type="button" target="_blank" class="btn bg-teal btn-block btn-lg waves-effect dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            Exporter en pdf <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            @if ($bilanTerga && $bilanHennaya)
                            <li><a href="{{url('/exportConsolideMensuel/'.$bilanTerga->mois.'/'.$bilanTerga->annee)}}" target="_blank" class=" waves-effect waves-block">bilan consolidé</a></li>
                            @endif
                            @if ($bilanTerga)
                            <li><a href="{{url('/exportBilanMensuel/'.$bilanTerga->id)}}" target="_blank" class=" waves-effect waves-block">Bilan unité Terga</a></li>
                            @endif
                            @if ($bilanHennaya)
                            <li><a href="{{url('/exportBilanMensuel/'.$bilanHennaya->id)}}" target="_blank" class=" waves-effect waves-block">Bilan unité Hennaya</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <ul class="nav nav-tabs tab-col-pink" role="tablist">
                        @if ($bilanTerga && $bilanHennaya)
                        <li role="presentation" class="active"><a href="#home" data-toggle="tab">Bilan consolidé</a></li>
                        @endif
                        @if ($bilanTerga)
                        <li role="presentation"><a href="#profile" data-toggle="tab">Unité Terga</a></li>
                        @endif
                        @if ($bilanHennaya)
                        <li role="presentation"><a href="#messages" data-toggle="tab">Unité Hennaya</a></li>
                        @endif
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        @if ($bilanTerga && $bilanHennaya)
                        <div role="tabpanel" class="tab-pane fade in active" id="home">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="card">
                                            <div class="header">
                                                <h2>
                                                    BILAN CONSOLIDE DES ACCIDENTS DE TRAVAIL DU MOIS DE " {{$mois}} {{$annee}} " 
                                                </h2>
                                            </div>
                                            <div class="body">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <p>Nombre des accidents de travail : {{$accidents_total}}</p>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <p>Nombre des journées perdues : {{$jours_total}}</p>
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
                                                            <th class="text-center"><strong>Jours</strong></th>
                                                            @foreach ($consolideParJours as $accidentsParJour)
                                                                <th class="text-center"> {{$accidentsParJour->jour}}</th>
                                                            @endforeach
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="text-center"><strong>Nbr d'accident sans arrêt</strong></td>
                                                        @foreach ($consolideParJours as $accidentsParJour)
                                                            <td class="text-center">{{$accidentsParJour->accidentsSans}}</td>
                                                        @endforeach
                                                        </tr>
                                                        <tr>
                                                            <td class="text-center"><strong>Nbr d'accident avec arrêt</strong></td>
                                                        @foreach ($consolideParJours as $accidentsParJour)
                                                            <td class="text-center">{{$accidentsParJour->accidentsAvec}}</td>
                                                        @endforeach
                                                        </tr>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>    
                                                            <th class="text-center"><strong>Total</strong></th>
                                                            @foreach ($totalParJour as $total)
                                                                <td class="text-center">{{$total}}</td>
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
                                                        @foreach ($consolideParHeur as $parHeure)
                                                        <tr>
                                                            <td class="text-center"><strong> {{$parHeure->heure}}</strong></td>
                                                            <td class="text-center">{{$parHeure->accidents}}</td>
                                                            <td class="text-center">
                                                                @php
                                                                    $pourcentage = $parHeure->accidents * 100 / $consolideParHeur->sum('accidents')
                                                                @endphp
                                                                {{$pourcentage}} %
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>    
                                                            <th class="text-center"><strong>Total</strong></th>
                                                            <th class="text-center">{{$consolideParHeur->sum('accidents')}}</th>
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
                                                        @foreach ($consolideParSiege as $parSiege)
                                                        <tr>
                                                            <td class="text-center"><strong> {{$parSiege->siege_lesions}}</strong></td>
                                                            <td class="text-center">{{$parSiege->accidents}}</td>
                                                            <td class="text-center">
                                                                @php
                                                                    $pourcentage = $parSiege->accidents * 100 / $consolideParSiege->sum('accidents')
                                                                @endphp
                                                                {{$pourcentage}} %
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>    
                                                            <th class="text-center"><strong>Total</strong></th>
                                                            <th class="text-center">{{$consolideParSiege->sum('accidents')}}</th>
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
                                                        @foreach ($consolideParAnc as $parAnc)
                                                        <tr>
                                                            <td class="text-center"><strong> {{$parAnc->anciennete}}</strong></td>
                                                            <td class="text-center">{{$parAnc->accidents}}</td>
                                                            <td class="text-center">
                                                                @php
                                                                    $pourcentage = $parAnc->accidents * 100 / $consolideParAnc->sum('accidents')
                                                                @endphp
                                                                {{$pourcentage}} %
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>    
                                                            <th class="text-center"><strong>Total</strong></th>
                                                            <th class="text-center">{{$consolideParAnc->sum('accidents')}}</th>
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
                                                        @foreach ($consolideParFct as $parFct)
                                                        <tr>
                                                            <td class="text-center"><strong> {{$parFct->fonction}}</strong></td>
                                                            <td class="text-center">{{$parFct->accidents}}</td>
                                                            <td class="text-center">
                                                                @php
                                                                    $pourcentage = $parFct->accidents * 100 / $consolideParFct->sum('accidents')
                                                                @endphp
                                                                {{$pourcentage}} %
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>    
                                                            <th class="text-center"><strong>Total</strong></th>
                                                            <th class="text-center">{{$consolideParFct->sum('accidents')}}</th>
                                                            <th class="text-center">100 %</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        @endif
                        @if ($bilanTerga)
                            @if (! $bilanHennaya) 
                            <div role="tabpanel" class="tab-pane in active" id="profile">
                            @else
                            <div role="tabpanel" class="tab-pane fade" id="profile">
                            @endif
                        
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="card">
                                            <div class="header">
                                                <h2>
                                                
                                                    BILAN DES ACCIDENTS DE TRAVAIL UNITE TERGA DU MOIS DE " {{$bilanTerga->mois}} {{$bilanTerga->annee}} " 
                                                </h2>
                                            </div>
                                            <div class="body">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <p>Nombre des accidents de travail : {{$bilanTerga->nbr_accidents}}</p>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <p>Nombre des journées perdues : {{$bilanTerga->nbr_jours}}</p>
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
                                                            <th class="text-center"><strong>Jours</strong></th>
                                                            @foreach ($bilanTerga->accidentsParJour as $accidentsParJour)
                                                                <th class="text-center"> {{$accidentsParJour->jour}}</th>
                                                            @endforeach
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="text-center"><strong>Nbr d'accident sans arrêt</strong></td>
                                                        @foreach ($bilanTerga->accidentsParJour as $accidentsParJour)
                                                            <td class="text-center">{{$accidentsParJour->sans_arret}}</td>
                                                        @endforeach
                                                        </tr>
                                                        <tr>
                                                            <td class="text-center"><strong>Nbr d'accident avec arrêt</strong></td>
                                                        @foreach ($bilanTerga->accidentsParJour as $accidentsParJour)
                                                            <td class="text-center">{{$accidentsParJour->avec_arret}}</td>
                                                        @endforeach
                                                        </tr>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>    
                                                            <th class="text-center"><strong>Total</strong></th>
                                                            @foreach ($totalParJourT as $total)
                                                                <td class="text-center">{{$total}}</td>
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
                                                        @foreach ($bilanTerga->accidentParHeure as $accidentParHeure)
                                                        <tr>
                                                            <td class="text-center"><strong> {{$accidentParHeure->heure}}</strong></td>
                                                            <td class="text-center">{{$accidentParHeure->nbr_accidents}}</td>
                                                            <td class="text-center">
                                                                @php
                                                                    $pourcentage = $accidentParHeure->nbr_accidents * 100 / $bilanTerga->accidentParHeure->sum('nbr_accidents')
                                                                @endphp
                                                                {{$pourcentage}} %
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>    
                                                            <th class="text-center"><strong>Total</strong></th>
                                                            <th class="text-center">{{$bilanTerga->accidentParHeure->sum('nbr_accidents')}}</th>
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
                                                        @foreach ($bilanTerga->accidentParSiege as $accidentParSiege)
                                                        <tr>
                                                            <td class="text-center"><strong> {{$accidentParSiege->siege_lesions}}</strong></td>
                                                            <td class="text-center">{{$accidentParSiege->nbr_accidents}}</td>
                                                            <td class="text-center">
                                                                @php
                                                                    $pourcentage = $accidentParSiege->nbr_accidents * 100 / $bilanTerga->accidentParSiege->sum('nbr_accidents')
                                                                @endphp
                                                                {{$pourcentage}} %
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>    
                                                            <th class="text-center"><strong>Total</strong></th>
                                                            <th class="text-center">{{$bilanTerga->accidentParSiege->sum('nbr_accidents')}}</th>
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
                                                        @foreach ($bilanTerga->accidentParAnciennete as $accidentParAnciennete)
                                                        <tr>
                                                            <td class="text-center"><strong> {{$accidentParAnciennete->anciennete}}</strong></td>
                                                            <td class="text-center">{{$accidentParAnciennete->nbr_accidents}}</td>
                                                            <td class="text-center">
                                                                @php
                                                                    $pourcentage = $accidentParAnciennete->nbr_accidents * 100 / $bilanTerga->accidentParAnciennete->sum('nbr_accidents')
                                                                @endphp
                                                                {{$pourcentage}} %
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>    
                                                            <th class="text-center"><strong>Total</strong></th>
                                                            <th class="text-center">{{$bilanTerga->accidentParAnciennete->sum('nbr_accidents')}}</th>
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
                                                        @foreach ($bilanTerga->accidentParFct as $accidentParFct)
                                                        <tr>
                                                            <td class="text-center"><strong> {{$accidentParFct->fonction}}</strong></td>
                                                            <td class="text-center">{{$accidentParFct->nbr_accidents}}</td>
                                                            <td class="text-center">
                                                                @php
                                                                    $pourcentage = $accidentParFct->nbr_accidents * 100 / $bilanTerga->accidentParFct->sum('nbr_accidents')
                                                                @endphp
                                                                {{$pourcentage}} %
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>    
                                                            <th class="text-center"><strong>Total</strong></th>
                                                            <th class="text-center">{{$bilanTerga->accidentParFct->sum('nbr_accidents')}}</th>
                                                            <th class="text-center">100 %</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if ($bilanHennaya)
                            @if (! $bilanTerga) 
                            <div role="tabpanel" class="tab-pane in active" id="messages">
                            @else
                            <div role="tabpanel" class="tab-pane fade" id="messages">
                            @endif
                            
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="card">
                                            <div class="header">
                                                <h2>
                                                
                                                    BILAN DES ACCIDENTS DE TRAVAIL UNITE HENNAYA DU MOIS DE " {{$bilanHennaya->mois}} {{$bilanHennaya->annee}} " 
                                                </h2>
                                            </div>
                                            <div class="body">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <p>Nombre des accidents de travail : {{$bilanHennaya->nbr_accidents}}</p>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <p>Nombre des journées perdues : {{$bilanHennaya->nbr_jours}}</p>
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
                                                            <th class="text-center"><strong>Jours</strong></th>
                                                            @foreach ($bilanHennaya->accidentsParJour as $accidentsParJour)
                                                                <th class="text-center"> {{$accidentsParJour->jour}}</th>
                                                            @endforeach
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="text-center"><strong>Nbr d'accident sans arrêt</strong></td>
                                                        @foreach ($bilanHennaya->accidentsParJour as $accidentsParJour)
                                                            <td class="text-center">{{$accidentsParJour->sans_arret}}</td>
                                                        @endforeach
                                                        </tr>
                                                        <tr>
                                                            <td class="text-center"><strong>Nbr d'accident avec arrêt</strong></td>
                                                        @foreach ($bilanHennaya->accidentsParJour as $accidentsParJour)
                                                            <td class="text-center">{{$accidentsParJour->avec_arret}}</td>
                                                        @endforeach
                                                        </tr>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>    
                                                            <th class="text-center"><strong>Total</strong></th>
                                                            @foreach ($totalParJourH as $total)
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
                                                        @foreach ($bilanHennaya->accidentParHeure as $accidentParHeure)
                                                        <tr>
                                                            <td class="text-center"><strong> {{$accidentParHeure->heure}}</strong></td>
                                                            <td class="text-center">{{$accidentParHeure->nbr_accidents}}</td>
                                                            <td class="text-center">
                                                                @php
                                                                    $pourcentage = $accidentParHeure->nbr_accidents * 100 / $bilanHennaya->accidentParHeure->sum('nbr_accidents')
                                                                @endphp
                                                                {{$pourcentage}} %
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>    
                                                            <th class="text-center"><strong>Total</strong></th>
                                                            <th class="text-center">{{$bilanHennaya->accidentParHeure->sum('nbr_accidents')}}</th>
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
                                                        @foreach ($bilanHennaya->accidentParSiege as $accidentParSiege)
                                                        <tr>
                                                            <td class="text-center"><strong> {{$accidentParSiege->siege_lesions}}</strong></td>
                                                            <td class="text-center">{{$accidentParSiege->nbr_accidents}}</td>
                                                            <td class="text-center">
                                                                @php
                                                                    $pourcentage = $accidentParSiege->nbr_accidents * 100 / $bilanHennaya->accidentParSiege->sum('nbr_accidents')
                                                                @endphp
                                                                {{$pourcentage}} %
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>    
                                                            <th class="text-center"><strong>Total</strong></th>
                                                            <th class="text-center">{{$bilanHennaya->accidentParSiege->sum('nbr_accidents')}}</th>
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
                                                        @foreach ($bilanHennaya->accidentParAnciennete as $accidentParAnciennete)
                                                        <tr>
                                                            <td class="text-center"><strong> {{$accidentParAnciennete->anciennete}}</strong></td>
                                                            <td class="text-center">{{$accidentParAnciennete->nbr_accidents}}</td>
                                                            <td class="text-center">
                                                                @php
                                                                    $pourcentage = $accidentParAnciennete->nbr_accidents * 100 / $bilanHennaya->accidentParAnciennete->sum('nbr_accidents')
                                                                @endphp
                                                                {{$pourcentage}} %
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>    
                                                            <th class="text-center"><strong>Total</strong></th>
                                                            <th class="text-center">{{$bilanHennaya->accidentParAnciennete->sum('nbr_accidents')}}</th>
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
                                                        @foreach ($bilanHennaya->accidentParFct as $accidentParFct)
                                                        <tr>
                                                            <td class="text-center"><strong> {{$accidentParFct->fonction}}</strong></td>
                                                            <td class="text-center">{{$accidentParFct->nbr_accidents}}</td>
                                                            <td class="text-center">
                                                                @php
                                                                    $pourcentage = $accidentParFct->nbr_accidents * 100 / $bilanHennaya->accidentParFct->sum('nbr_accidents')
                                                                @endphp
                                                                {{$pourcentage}} %
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>    
                                                            <th class="text-center"><strong>Total</strong></th>
                                                            <th class="text-center">{{$bilanHennaya->accidentParFct->sum('nbr_accidents')}}</th>
                                                            <th class="text-center">100 %</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')

@endsection