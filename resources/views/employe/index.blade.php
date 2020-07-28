@extends('layouts.datatable')

@section('titre')
<title>Employés | APMC Divindus</title>
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
        <li class="active">
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
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                
                @if (!Auth::user()->is_admin)
                <form action="{{url('employes/import')}}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row" style="margin-bottom: 25px">

                        <div class="col-md-6 col-lg-6">
                        </div>
                        <div class="col-md-3 col-lg-3">
                            <button type="button" class="btn bg-teal btn-block btn-lg waves-effect" data-toggle="modal" data-target="#import">Importer un fichier excel</button>
                        </div>
                        <div class="col-md-3 col-lg-3">
                            <button type="button" class="btn bg-teal btn-block btn-lg waves-effect" data-toggle="modal" data-target="#nv_e">Ajouter un employé</button>
                        </div>
                    </div>
                </form>
                @endif
                <div class="card">
                    <div class="body">

                        <div class="table-responsive">

                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>Matricule</th>
                                        <th>Nom</th>
                                        @if (Auth::user()->is_admin)
                                        <th>Unité</th>
                                        @endif
                                        <th>date de recrutement</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($employes as $employe)
                                    <tr>
                                    
                                        <td>{{$employe->matricule}}</td>
                                        <td>{{$employe->nom}} {{$employe->prenom}}</td>
                                        @if (Auth::user()->is_admin)
                                            <td>{{$employe->unite}}</td>
                                        @endif
                                        <td>{{$employe->date_rec}}</td>
                                        <td>
                                            <div class="icon-button-demo">
                                                <a href="show1.html" type="button" class="btn bg-cyan btn-circle waves-effect waves-circle waves-float">
                                                    <i class="material-icons">details</i>
                                                </a>
                                                @if (!Auth::user()->is_admin)
                                                <a type="button" class="btn bg-light-green btn-circle waves-effect waves-circle waves-float">
                                                    <i class="material-icons">edit</i>
                                                </a>
                                                <a type="button" class="btn bg-red btn-circle waves-effect waves-circle waves-float">
                                                    <i class="material-icons">delete_forever</i>
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

<div class="modal fade" id="import" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form action="{{url('employes/import')}}" id="frmFileUpload" class="dropzone" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="modal-content">
                <div class="modal-body">
                        <input id="upload" name="file" class="file-upload__input" type="file" >
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-link waves-effect">Valider</button>
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Annuler</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="nv_e" tabindex="-1" role="dialog">
    <div class="modal-dialog window-popup edit-my-poll-popup" role="document">
        <div class="modal-content">
            <a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close">
                <svg class="olymp-close-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-close-icon"></use></svg>
            </a>
            <form class="resume-form" method="POST" action="{{url('employes')}}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="edit-my-poll-content">
                        
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control">
                                        <label class="form-label">Nom et Prénom</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class=" col-sm-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control">
                                        <label class="form-label">Statut</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="form-group">
                                <div class="col-sm-4">
                                    <label for="">Date de naissance</label>
                                </div>
                                <div class="col-sm-8">
                                    <div class="form-line" id="bs_datepicker_container">
                                        <input type="date" class="form-control" placeholder="Date de naissance ">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="form-group">
                                <div class="col-sm-4">
                                    <label for="">Date de recrutement</label>
                                </div>
                                <div class="col-sm-8">
                                    <div class="form-line" id="bs_datepicker_container">
                                        <input type="date" class="form-control" placeholder="Date de recrutement">
                                    </div>
                                </div>
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
</section>

@endsection