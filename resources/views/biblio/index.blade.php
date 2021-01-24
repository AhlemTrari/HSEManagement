
@extends('layouts.datatable')

@section('titre')
<title>Bibliothèque | APMC Divindus</title>
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
        <li>
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons">security</i>
                <span>HSE</span>
            </a>
            <ul class="ml-menu">
                <li >
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
        <li class="active">
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
                    @if ( Auth::user()->is_admin)
                        <button type="button" class="btn bg-teal btn-block btn-lg waves-effect" data-toggle="modal" data-target="#nv">Nouvelle bibliothèque</button>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Bibliothèque :
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>Emplacement</th>
                                        <th style="width: 20%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($emplacements as $emplacement)
                                    <tr>
                                        <td>{{$emplacement->intitule}}</td>
                                        <td>
                                            <div class="icon-button-demo">
                                                <a href="{{url('/Bibliotheque/details/'.$emplacement->id)}}" title="Afficher les cartes de cette emplacement" class="btn bg-cyan btn-circle waves-effect waves-circle waves-float">
                                                    <i class="material-icons">details</i>
                                                </a>
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

<div class="modal fade" id="nv" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form action="{{url('/Bibliotheque')}}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="largeModalLabel">Imprter un fichier</h4>
                </div>
                <div class="modal-body">
                    <div class="row clearfix" style="margin-top: 30px">
                        
                        <div class="col-sm-12">
                            <div class="row">
                                <div class=" col-xs-10">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <select name="emplacement" class="form-control show-tick" required>
                                                <option value="">-- Selectionnez l'emplacement --</option>
                                                @foreach ($allEmplacements as $emplacement)
                                                <option value="{{$emplacement->id}}">{{$emplacement->intitule}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <button type="button" title="nouvel emplacement" data-toggle="modal" data-target="#biblioEmplacement" class="add-row btn bg-light-green btn-circle waves-effect waves-circle waves-float">
                                        <i class="material-icons">add_circle</i>
                                    </button>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="intitule" class="form-control" placeholder="Intitulé" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-line">
                                    <input id="upload" name="file" class="file-upload__input" type="file" accept="application/pdf" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-link waves-effect">Valider</button>
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Annuler</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="biblioEmplacement" tabindex="-1" role="dialog" style="padding-top: 50px">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="largeModalLabel">Nouvel emplacement</h4>
            </div>
            <form id="addBiblioEmplacement">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="row clearfix" style="margin-top: 30px">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="intitule" name="intitule" class="form-control" placeholder="Emplacement" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-link waves-effect">Valider</button>
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Annuler</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection