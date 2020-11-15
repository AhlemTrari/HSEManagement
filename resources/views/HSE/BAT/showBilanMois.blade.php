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
                    <div class="col-md-8"></div>
                    <div class="col-md-4 clearfix demo-button-sizes" style="float: right">
                        <a href="{{url('/exportBilanMensuel/'.$bilan->id)}}" type="button" target="_blank" class="btn bg-teal btn-block btn-lg waves-effect">
                            Exporter en pdf
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                               
                                BILAN DES ACCIDENTS DE TRAVAIL DU MOIS DE " {{$bilan->mois}} {{$bilan->annee}} " 
                            </h2>
                        </div>
                        <div class="body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <p>Nombre des accidents de travail : {{$bilan->nbr_accidents}}</p>
                                </div>
                                <div class="col-sm-6">
                                    <p>Nombre des journées perdues : {{$bilan->nbr_jours}}</p>
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
                                        @foreach ($bilan->accidentsParJour as $accidentsParJour)
                                            <th class="text-center"> {{$accidentsParJour->jour}}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center"><strong>Nbr d'accident sans arrêt</strong></td>
                                    @foreach ($bilan->accidentsParJour as $accidentsParJour)
                                        <td class="text-center">{{$accidentsParJour->avec_arret}}</td>
                                    @endforeach
                                    </tr>
                                    <tr>
                                        <td class="text-center"><strong>Nbr d'accident avec arrêt</strong></td>
                                    @foreach ($bilan->accidentsParJour as $accidentsParJour)
                                        <td class="text-center">{{$accidentsParJour->sans_arret}}</td>
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
                                    @foreach ($bilan->accidentParHeure as $accidentParHeure)
                                    <tr>
                                        <td class="text-center"><strong> {{$accidentParHeure->heure}}</strong></td>
                                        <td class="text-center">{{$accidentParHeure->nbr_accidents}}</td>
                                        <td class="text-center">
                                            @php
                                                $pourcentage = $accidentParHeure->nbr_accidents * 100 / $bilan->accidentParHeure->sum('nbr_accidents')
                                            @endphp
                                            {{$pourcentage}} %
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>    
                                        <th class="text-center"><strong>Total</strong></th>
                                        <th class="text-center">{{$bilan->accidentParHeure->sum('nbr_accidents')}}</th>
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
                                    @foreach ($bilan->accidentParSiege as $accidentParSiege)
                                    <tr>
                                        <td class="text-center"><strong> {{$accidentParSiege->siege_lesions}}</strong></td>
                                        <td class="text-center">{{$accidentParSiege->nbr_accidents}}</td>
                                        <td class="text-center">
                                            @php
                                                $pourcentage = $accidentParSiege->nbr_accidents * 100 / $bilan->accidentParSiege->sum('nbr_accidents')
                                            @endphp
                                            {{$pourcentage}} %
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>    
                                        <th class="text-center"><strong>Total</strong></th>
                                        <th class="text-center">{{$bilan->accidentParSiege->sum('nbr_accidents')}}</th>
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
                                    @foreach ($bilan->accidentParAnciennete as $accidentParAnciennete)
                                    <tr>
                                        <td class="text-center"><strong> {{$accidentParAnciennete->anciennete}}</strong></td>
                                        <td class="text-center">{{$accidentParAnciennete->nbr_accidents}}</td>
                                        <td class="text-center">
                                            @php
                                                $pourcentage = $accidentParAnciennete->nbr_accidents * 100 / $bilan->accidentParAnciennete->sum('nbr_accidents')
                                            @endphp
                                            {{$pourcentage}} %
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>    
                                        <th class="text-center"><strong>Total</strong></th>
                                        <th class="text-center">{{$bilan->accidentParAnciennete->sum('nbr_accidents')}}</th>
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
                                    @foreach ($bilan->accidentParFct as $accidentParFct)
                                    <tr>
                                        <td class="text-center"><strong> {{$accidentParFct->fonction}}</strong></td>
                                        <td class="text-center">{{$accidentParFct->nbr_accidents}}</td>
                                        <td class="text-center">
                                            @php
                                                $pourcentage = $accidentParFct->nbr_accidents * 100 / $bilan->accidentParFct->sum('nbr_accidents')
                                            @endphp
                                            {{$pourcentage}} %
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>    
                                        <th class="text-center"><strong>Total</strong></th>
                                        <th class="text-center">{{$bilan->accidentParFct->sum('nbr_accidents')}}</th>
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