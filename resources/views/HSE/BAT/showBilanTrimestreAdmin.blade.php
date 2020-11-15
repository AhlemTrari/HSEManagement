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
                <div class="row">
                    <div class="col-md-8">
                        
                    </div>
                    <div class="col-md-4 clearfix demo-button-sizes" style="float: right">
                        <a href="#" type="button" target="_blank" class="btn bg-teal btn-block btn-lg waves-effect dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            Exporter en pdf <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            @if ($bilanT && $bilanH)
                            <li><a href="{{url('/exportConsolideTrimestriel/'.$t.'/'.$annee)}}" target="_blank" class=" waves-effect waves-block">bilan consolidé</a></li>
                            @endif
                            @if ($bilanT)
                            <li><a href="{{url('/exportBilanTrimestriel/'.$bilanT->id)}}" target="_blank" class=" waves-effect waves-block">Bilan unité Terga</a></li>
                            @endif
                            @if ($bilanH)
                            <li><a href="{{url('/exportBilanTrimestriel/'.$bilanH->id)}}" target="_blank" class=" waves-effect waves-block">Bilan unité Hennaya</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <ul class="nav nav-tabs tab-col-pink" role="tablist">
                        @if ($bilanT && $bilanH)
                        <li role="presentation" class="active"><a href="#home" data-toggle="tab">Bilan consolidé</a></li>
                        @endif
                        @if ($bilanT)
                        <li role="presentation"><a href="#profile" data-toggle="tab">Unité Terga</a></li>
                        @endif
                        @if ($bilanH)
                        <li role="presentation"><a href="#messages" data-toggle="tab">Unité Hennaya</a></li>
                        @endif
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        @if ($bilanT && $bilanH)
                        <div role="tabpanel" class="tab-pane fade in active" id="home">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="card">
                                            <div class="header">
                                                <h2>
                                                    BILAN CONSOLIDE DES ACCIDENTS DE TRAVAIL DU TRIMESTRE " {{$t}} {{$annee}} " 
                                                </h2>
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
                                                            <th class="text-center"><strong>Mois</strong></th>
                                                            @foreach ($parMoisC as $bilanMensuel)
                                                                <th class="text-center"> {{$bilanMensuel->mois}}</th>
                                                            @endforeach
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="text-center"><strong>Nbr d'accident de travail</strong></td>
                                                            @foreach ($parMoisC as $bilanMensuel)
                                                                <td class="text-center"> {{$bilanMensuel->accidents}}</td>
                                                            @endforeach
                                                        </tr>
                                                        <tr>
                                                            <td class="text-center"><strong>Nbr de journées perdues</strong></td>
                                                            @foreach ($parMoisC as $bilanMensuel)
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
                                                            @foreach ($parJoursC as $accidentsParJour)
                                                                <th class="text-center"> {{$accidentsParJour->jour}}</th>
                                                            @endforeach
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="text-center"><strong>Nbr d'accident sans arrêt</strong></td>
                                                        @foreach ($parJoursC as $accidentsParJour)
                                                            <td class="text-center">{{$accidentsParJour->accidentsSans}}</td>
                                                        @endforeach
                                                        </tr>
                                                        <tr>
                                                            <td class="text-center"><strong>Nbr d'accident avec arrêt</strong></td>
                                                        @foreach ($parJoursC as $accidentsParJour)
                                                            <td class="text-center">{{$accidentsParJour->accidentsAvec}}</td>
                                                        @endforeach
                                                        </tr>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>    
                                                            <th class="text-center"><strong>Total</strong></th>
                                                            @foreach ($totalParJourC as $total)
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
                                                        @foreach ($parHeurC as $parHeure)
                                                        <tr>
                                                            <td class="text-center"><strong> {{$parHeure->heure}}</strong></td>
                                                            <td class="text-center">{{$parHeure->accidents}}</td>
                                                            <td class="text-center">
                                                                @php
                                                                    $pourcentage = $parHeure->accidents * 100 / $parHeurC->sum('accidents')
                                                                @endphp
                                                                {{$pourcentage}} %
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>    
                                                            <th class="text-center"><strong>Total</strong></th>
                                                            <th class="text-center">{{$parHeurC->sum('accidents')}}</th>
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
                                                        @foreach ($parSiegesC as $parSiege)
                                                        <tr>
                                                            <td class="text-center"><strong> {{$parSiege->siege_lesions}}</strong></td>
                                                            <td class="text-center">{{$parSiege->accidents}}</td>
                                                            <td class="text-center">
                                                                @php
                                                                    $pourcentage = $parSiege->accidents * 100 / $parSiegesC->sum('accidents')
                                                                @endphp
                                                                {{$pourcentage}} %
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>    
                                                            <th class="text-center"><strong>Total</strong></th>
                                                            <th class="text-center">{{$parSiegesC->sum('accidents')}}</th>
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
                                                        @foreach ($parAncienneteC as $parAnc)
                                                        <tr>
                                                            <td class="text-center"><strong> {{$parAnc->anciennete}}</strong></td>
                                                            <td class="text-center">{{$parAnc->accidents}}</td>
                                                            <td class="text-center">
                                                                @php
                                                                    $pourcentage = $parAnc->accidents * 100 / $parAncienneteC->sum('accidents')
                                                                @endphp
                                                                {{$pourcentage}} %
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>    
                                                            <th class="text-center"><strong>Total</strong></th>
                                                            <th class="text-center">{{$parAncienneteC->sum('accidents')}}</th>
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
                                                        @foreach ($parFonctionC as $parFct)
                                                        <tr>
                                                            <td class="text-center"><strong> {{$parFct->fonction}}</strong></td>
                                                            <td class="text-center">{{$parFct->accidents}}</td>
                                                            <td class="text-center">
                                                                @php
                                                                    $pourcentage = $parFct->accidents * 100 / $parFonctionC->sum('accidents')
                                                                @endphp
                                                                {{$pourcentage}} %
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>    
                                                            <th class="text-center"><strong>Total</strong></th>
                                                            <th class="text-center">{{$parFonctionC->sum('accidents')}}</th>
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
                        @if ($bilanT)
                            @if (! $bilanH) 
                            <div role="tabpanel" class="tab-pane in active" id="profile">
                            @else
                            <div role="tabpanel" class="tab-pane fade" id="profile">
                            @endif
                        
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="card">
                                            <div class="header">
                                                <h2>
                                                
                                                    BILAN DES ACCIDENTS DE TRAVAIL UNITE TERGA DU TRIMESTRE " {{$bilanT->trimestre}} {{$bilanT->annee}} " 
                                                </h2>
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
                                                            <th class="text-center"><strong>Mois</strong></th>
                                                            @foreach ($parMoisT as $bilanMensuel)
                                                                <th class="text-center"> {{$bilanMensuel->mois}}</th>
                                                            @endforeach
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="text-center"><strong>Nbr d'accident de travail</strong></td>
                                                            @foreach ($parMoisT as $bilanMensuel)
                                                                <td class="text-center"> {{$bilanMensuel->accidents}}</td>
                                                            @endforeach
                                                        </tr>
                                                        <tr>
                                                            <td class="text-center"><strong>Nbr de journées perdues</strong></td>
                                                            @foreach ($parMoisT as $bilanMensuel)
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
                                                            @foreach ($parJoursT as $accidentsParJour)
                                                                <th class="text-center"> {{$accidentsParJour->jour}}</th>
                                                            @endforeach
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="text-center"><strong>Nbr d'accident sans arrêt</strong></td>
                                                        @foreach ($parJoursT as $accidentsParJour)
                                                            <td class="text-center">{{$accidentsParJour->accidentsSans}}</td>
                                                        @endforeach
                                                        </tr>
                                                        <tr>
                                                            <td class="text-center"><strong>Nbr d'accident avec arrêt</strong></td>
                                                        @foreach ($parJoursT as $accidentsParJour)
                                                            <td class="text-center">{{$accidentsParJour->accidentsAvec}}</td>
                                                        @endforeach
                                                        </tr>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>    
                                                            <th class="text-center"><strong>Total</strong></th>
                                                            @foreach ($totalParJourT as $total)
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
                                                        @foreach ($parHeurT as $parHeure)
                                                        <tr>
                                                            <td class="text-center"><strong> {{$parHeure->heure}}</strong></td>
                                                            <td class="text-center">{{$parHeure->accidents}}</td>
                                                            <td class="text-center">
                                                                @php
                                                                    $pourcentage = $parHeure->accidents * 100 / $parHeurT->sum('accidents')
                                                                @endphp
                                                                {{$pourcentage}} %
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>    
                                                            <th class="text-center"><strong>Total</strong></th>
                                                            <th class="text-center">{{$parHeurT->sum('accidents')}}</th>
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
                                                        @foreach ($parSiegesT as $parSiege)
                                                        <tr>
                                                            <td class="text-center"><strong> {{$parSiege->siege_lesions}}</strong></td>
                                                            <td class="text-center">{{$parSiege->accidents}}</td>
                                                            <td class="text-center">
                                                                @php
                                                                    $pourcentage = $parSiege->accidents * 100 / $parSiegesT->sum('accidents')
                                                                @endphp
                                                                {{$pourcentage}} %
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>    
                                                            <th class="text-center"><strong>Total</strong></th>
                                                            <th class="text-center">{{$parSiegesT->sum('accidents')}}</th>
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
                                                        @foreach ($parAncienneteT as $parAnc)
                                                        <tr>
                                                            <td class="text-center"><strong> {{$parAnc->anciennete}}</strong></td>
                                                            <td class="text-center">{{$parAnc->accidents}}</td>
                                                            <td class="text-center">
                                                                @php
                                                                    $pourcentage = $parAnc->accidents * 100 / $parAncienneteT->sum('accidents')
                                                                @endphp
                                                                {{$pourcentage}} %
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>    
                                                            <th class="text-center"><strong>Total</strong></th>
                                                            <th class="text-center">{{$parAncienneteT->sum('accidents')}}</th>
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
                                                        @foreach ($parFonctionT as $parFct)
                                                        <tr>
                                                            <td class="text-center"><strong> {{$parFct->fonction}}</strong></td>
                                                            <td class="text-center">{{$parFct->accidents}}</td>
                                                            <td class="text-center">
                                                                @php
                                                                    $pourcentage = $parFct->accidents * 100 / $parFonctionT->sum('accidents')
                                                                @endphp
                                                                {{$pourcentage}} %
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>    
                                                            <th class="text-center"><strong>Total</strong></th>
                                                            <th class="text-center">{{$parFonctionT->sum('accidents')}}</th>
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
                        @if ($bilanH)
                            @if (! $bilanT) 
                            <div role="tabpanel" class="tab-pane in active" id="messages">
                            @else
                            <div role="tabpanel" class="tab-pane fade" id="messages">
                            @endif
                        
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="card">
                                        <div class="header">
                                            <h2>
                                            
                                                BILAN DES ACCIDENTS DE TRAVAIL UNITE TERGA DU TRIMESTRE " {{$bilanH->trimestre}} {{$bilanH->annee}} " 
                                            </h2>
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
                                                        <th class="text-center"><strong>Mois</strong></th>
                                                        @foreach ($parMoisH as $bilanMensuel)
                                                            <th class="text-center"> {{$bilanMensuel->mois}}</th>
                                                        @endforeach
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="text-center"><strong>Nbr d'accident de travail</strong></td>
                                                        @foreach ($parMoisH as $bilanMensuel)
                                                            <td class="text-center"> {{$bilanMensuel->accidents}}</td>
                                                        @endforeach
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center"><strong>Nbr de journées perdues</strong></td>
                                                        @foreach ($parMoisH as $bilanMensuel)
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
                                                        @foreach ($parJoursH as $accidentsParJour)
                                                            <th class="text-center"> {{$accidentsParJour->jour}}</th>
                                                        @endforeach
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="text-center"><strong>Nbr d'accident sans arrêt</strong></td>
                                                    @foreach ($parJoursH as $accidentsParJour)
                                                        <td class="text-center">{{$accidentsParJour->accidentsSans}}</td>
                                                    @endforeach
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center"><strong>Nbr d'accident avec arrêt</strong></td>
                                                    @foreach ($parJoursH as $accidentsParJour)
                                                        <td class="text-center">{{$accidentsParJour->accidentsAvec}}</td>
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
                                                    @foreach ($parHeurH as $parHeure)
                                                    <tr>
                                                        <td class="text-center"><strong> {{$parHeure->heure}}</strong></td>
                                                        <td class="text-center">{{$parHeure->accidents}}</td>
                                                        <td class="text-center">
                                                            @php
                                                                $pourcentage = $parHeure->accidents * 100 / $parHeurH->sum('accidents')
                                                            @endphp
                                                            {{$pourcentage}} %
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>    
                                                        <th class="text-center"><strong>Total</strong></th>
                                                        <th class="text-center">{{$parHeurH->sum('accidents')}}</th>
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
                                                    @foreach ($parSiegesH as $parSiege)
                                                    <tr>
                                                        <td class="text-center"><strong> {{$parSiege->siege_lesions}}</strong></td>
                                                        <td class="text-center">{{$parSiege->accidents}}</td>
                                                        <td class="text-center">
                                                            @php
                                                                $pourcentage = $parSiege->accidents * 100 / $parSiegesH->sum('accidents')
                                                            @endphp
                                                            {{$pourcentage}} %
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>    
                                                        <th class="text-center"><strong>Total</strong></th>
                                                        <th class="text-center">{{$parSiegesH->sum('accidents')}}</th>
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
                                                    @foreach ($parAncienneteH as $parAnc)
                                                    <tr>
                                                        <td class="text-center"><strong> {{$parAnc->anciennete}}</strong></td>
                                                        <td class="text-center">{{$parAnc->accidents}}</td>
                                                        <td class="text-center">
                                                            @php
                                                                $pourcentage = $parAnc->accidents * 100 / $parAncienneteH->sum('accidents')
                                                            @endphp
                                                            {{$pourcentage}} %
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>    
                                                        <th class="text-center"><strong>Total</strong></th>
                                                        <th class="text-center">{{$parAncienneteH->sum('accidents')}}</th>
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
                                                    @foreach ($parFonctionH as $parFct)
                                                    <tr>
                                                        <td class="text-center"><strong> {{$parFct->fonction}}</strong></td>
                                                        <td class="text-center">{{$parFct->accidents}}</td>
                                                        <td class="text-center">
                                                            @php
                                                                $pourcentage = $parFct->accidents * 100 / $parFonctionH->sum('accidents')
                                                            @endphp
                                                            {{$pourcentage}} %
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>    
                                                        <th class="text-center"><strong>Total</strong></th>
                                                        <th class="text-center">{{$parFonctionH->sum('accidents')}}</th>
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
