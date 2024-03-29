@extends('layouts.datatable')

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
                <span>Accueil</span>
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
            <div class="row" style="margin-bottom: 25px">
                <div class="col-md-6 col-lg-6">
                </div>
                <div class="col-md-3 col-lg-3">
                    @if (! Auth::user()->is_admin)
                        <a type="button" href="{{url('/BilanAccidentT/create')}}" class="btn bg-teal btn-block btn-lg waves-effect">Nouveau bilan</a>
                    @endif
                </div>
                @if ( Auth::user()->is_admin)
                <div class="col-md-3 col-lg-3">
                    <a href="#" type="button" target="_blank" class="btn bg-teal btn-block btn-lg waves-effect dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        Exporter le bilan annuel <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        @if ($bilanTerga && $bilanHennaya)
                        <li><a href="{{url('/exportConsolideAnnuel/'.$annee)}}" target="_blank" class=" waves-effect waves-block">bilan consolidé</a></li>
                        @endif
                        @if ($bilanTerga)
                        <li><a href="{{url('/exportBilanAnnuel/'.$bilanTerga->id)}}" target="_blank" class=" waves-effect waves-block">Bilan unité Terga</a></li>
                        @endif
                        @if ($bilanHennaya)
                        <li><a href="{{url('/exportBilanAnnuel/'.$bilanHennaya->id)}}" target="_blank" class=" waves-effect waves-block">Bilan unité Hennaya</a></li>
                        @endif
                    </ul>
                </div>
                @else
                <div class="col-md-3 col-lg-3">
                    <a href="{{url('/exportBilanAnnuel/'.$bilanAnnuel->id)}}" type="button" target=”_blank” class="btn bg-teal btn-block btn-lg waves-effect">Exporter le bilan annuel</a>
                </div>
                @endif
            </div>
            
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Bilan des accidents de travail par mois :
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>Intitulé</th>
                                            <th>Mois</th>
                                            <th>Année</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bilans as $bilan)
                                        <tr>
                                            <td>Bilan des accidents de travail {{$bilan->annee}}</td>
                                            <td >{{$bilan->mois}}</td>
                                            
                                            <td >{{$bilan->annee}}</td>
                                            <td >
                                                <div class="icon-button-demo">
                                                    @if (Auth::user()->is_admin)
                                                    <a href="{{url('/BilanAccidentT/BilanMoisA/'.$bilan->mois.'/'.$bilan->annee)}}" title="Détails" type="button" class="btn bg-cyan btn-circle waves-effect waves-circle waves-float">
                                                        <i class="material-icons">visibility</i>
                                                    </a> 
                                                    @else
                                                    <a href="{{url('/BilanAccidentT/BilanMois/'.$bilan->id)}}" type="button" title="Détails" class="btn bg-cyan btn-circle waves-effect waves-circle waves-float">
                                                        <i class="material-icons">visibility</i>
                                                    </a> 
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                        
                                    </tbody>
                                </table>
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
                                Bilan des accidents de travail par trimestre :
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">

                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>Intitulé</th>
                                            <th>Trimestre</th>
                                            <th>Année</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            @foreach ($bilansTrimestriel as $bilan)
                                            <tr>
                                                <td>Bilan des accidents de travail {{$bilan->annee}}</td>
                                                <td >{{$bilan->trimestre}}</td>
                                                <td >{{$bilan->annee}}</td>
                                                <td >
                                                    <div class="icon-button-demo">
                                                        @if (Auth::user()->is_admin)
                                                        <a href="{{url('/BilanAccidentT/BilanTrimestreA/'.$bilan->trimestre.'/'.$bilan->annee)}}" title="Détails" type="button" class="btn bg-cyan btn-circle waves-effect waves-circle waves-float">
                                                            <i class="material-icons">visibility</i>
                                                        </a> 
                                                        @else
                                                        <a href="{{url('/BilanAccidentT/BilanTrimestre/'.$bilan->id)}}" type="button" title="Détails" class="btn bg-cyan btn-circle waves-effect waves-circle waves-float">
                                                            <i class="material-icons">visibility</i>
                                                        </a> 
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                    </tbody>
                                </table>
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
                                Bilan des accidents de travail par semestre :
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">

                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>Intitulé</th>
                                            <th>Semestre</th>
                                            <th>Année</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bilansSemestriel as $bilan)
                                            <tr>
                                                <td>Bilan des accidents de travail {{$bilan->annee}}</td>
                                                <td >{{$bilan->semestre}}</td>
                                                <td >{{$bilan->annee}}</td>
                                                <td >
                                                    <div class="icon-button-demo">
                                                        @if (Auth::user()->is_admin)
                                                        <a href="{{url('/BilanAccidentT/BilanSemestreA/'.$bilan->semestre.'/'.$bilan->annee)}}" type="button" title="Détails" class="btn bg-cyan btn-circle waves-effect waves-circle waves-float">
                                                            <i class="material-icons">visibility</i>
                                                        </a> 
                                                        @else
                                                        <a href="{{url('/BilanAccidentT/BilanSemestre/'.$bilan->id)}}" type="button" title="Détails" class="btn bg-cyan btn-circle waves-effect waves-circle waves-float">
                                                            <i class="material-icons">visibility</i>
                                                        </a> 
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')

   
@endsection