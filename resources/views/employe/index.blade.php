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
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                
                <div class="row" style="margin-bottom: 25px">
                    <div class="col-md-3 col-lg-3"></div>
                        @if (!Auth::user()->is_admin)
                        <form action="{{url('employes/import')}}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="col-md-3 col-lg-3">
                                <button type="button" class="btn bg-teal btn-block btn-lg waves-effect" data-toggle="modal" data-target="#import">Importer un fichier excel</button>
                            </div>
                            <div class="col-md-3 col-lg-3">
                                <button type="button" class="btn bg-teal btn-block btn-lg waves-effect" data-toggle="modal" data-target="#nv_e">Ajouter un employé</button>
                            </div>
                        </form>
                        @endif
                        <div class="col-md-3 col-lg-3" style="float: right">
                            <a href="{{url('/employes/export')}}" type="button" class="btn bg-teal btn-block btn-lg waves-effect">Exporter la liste des employés</a>
                        </div>
                </div>
                <div class="card">
                    <div class="body">
                        
                        @include('flash-message')
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
                                            @if ($employe->unite == 1)
                                                <td>Unité Terga</td>
                                            @else
                                                <td>Unité Hennaya</td>
                                            @endif
                                        @endif
                                        <td>{{$employe->date_rec}}</td>
                                        <td>
                                            <div class="icon-button-demo">
                                                <a href="{{url('/employes/profil/'.$employe->id)}}" type="button" title="Détails" class="btn bg-cyan btn-circle waves-effect waves-circle waves-float">
                                                    <i class="material-icons" >visibility</i>
                                                </a>
                                                @if (!Auth::user()->is_admin)
                                                <a href="#edit{{ $employe->id }}Modal" type="button" data-toggle="modal" type="button" title="Modifier" class="btn bg-light-green btn-circle waves-effect waves-circle waves-float">
                                                    <i class="material-icons">edit</i>
                                                </a>
                                                <div class="modal fade" id="edit{{ $employe->id }}Modal" tabindex="-1" role="dialog" aria-labelledby="edit{{ $employe->id }}ModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <form action="{{url('employes/'.$employe->id)}}" method="POST" enctype="multipart/form-data">
                                                            <input type="hidden" name="_method" value="PUT">
                                                            {{ csrf_field() }}
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title" id="largeModalLabel">Modifier un employé</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    
                                                                    <div class="row clearfix" style="margin-top: 30px">
                                                                        <div class="col-sm-12">
                                                                            <div class="form-group row" style="margin-top: 10px">
                                                                                <div class="col-md-4">
                                                                                    <label style="margin-top: 10px">Matricule</label>
                                                                                </div>
                                                                                <div class="col-md-8">
                                                                                    <div class="form-line">
                                                                                        <input type="text" class="form-control" name="matricule" value="{{$employe->matricule}}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row" style="margin-top: 10px">
                                                                                <div class="col-md-4">
                                                                                    <label style="margin-top: 10px">Nom & Prénom</label>
                                                                                </div>
                                                                                <div class="col-md-8">
                                                                                    <div class="form-line">
                                                                                        <input type="text" class="form-control" name="nom" value="{{$employe->nom}}" placeholder="Nom et prénom">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            
                                                                            <div class="form-group row" style="margin-top: 10px">
                                                                                <div class="col-md-4">
                                                                                    <label style="margin-top: 10px">Sexe</label>
                                                                                </div>
                                                                                <div class="col-md-8">
                                                                                    <div class="demo-radio-button">
                                                                                        <input name="sexe" type="radio" id="radio_9" value="Homme" {{ $employe->sexe == 'Homme' ? 'checked' : ''}}>
                                                                                        <label for="radio_9">Homme</label>
                                                                                        <input name="sexe" type="radio" id="radio_10" value="Femme" {{ $employe->sexe == 'Femme' ? 'checked' : ''}}>
                                                                                        <label for="radio_10">Femme</label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row" style="margin-top: 10px">
                                                                                <div class="col-md-4">
                                                                                    <label style="margin-top: 10px">Fonction</label>
                                                                                </div>
                                                                                <div class="col-md-8">
                                                                                    <select name="fonction" class="form-control show-tick" required>
                                                                                        <option value="">-- Selectionnez une fonction --</option>
                                                                                        @foreach ($fonctions as $fct)
                                                                                        <option value="{{$fct->intitule}}" {{ $employe->fonction == $fct->intitule ? 'selected' : '' }}>{{$fct->intitule}}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row" style="margin-top: 10px">
                                                                                <div class="col-md-4">
                                                                                    <label style="margin-top: 10px">Statut</label>
                                                                                </div>
                                                                                <div class="col-md-8">
                                                                                    <div class="demo-radio-button">
                                                                                        <input name="statut" type="radio" id="radio_11" value="Actif" {{ $employe->statut == 'Actif' ? 'checked' : ''}}>
                                                                                        <label for="radio_11">Actif</label>
                                                                                        <input name="statut" type="radio" id="radio_12" value="Non actif" {{ $employe->statut == 'Non actif' ? 'checked' : ''}}>
                                                                                        <label for="radio_12">Non actif</label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <div class="col-md-4">
                                                                                    <label style="margin-top: 10px">Date de naissance</label>
                                                                                </div>
                                                                                <div class="col-md-8">
                                                                                    <div class="form-line">
                                                                                        <input type="date" name="date_naissance" class="form-control date" value="{{$employe->date_naissance}}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <div class="col-md-4">
                                                                                    <label style="margin-top: 10px">Date de recrutement</label>
                                                                                </div>
                                                                                <div class="col-md-8">
                                                                                    <div class="form-line">
                                                                                        <input type="date" name="date_rec" class="form-control date" value="{{$employe->date_rec}}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <div class="col-md-4">
                                                                                    <label style="margin-top: 10px">Affectation</label>
                                                                                </div>
                                                                                <div class="col-md-8">
                                                                                    <div class="form-line">
                                                                                        <input type="text" class="form-control" name="affectation" value="{{$employe->affectation}}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <div class="col-md-4">
                                                                                    <label style="margin-top: 10px">Poste à risque</label>
                                                                                </div>
                                                                                <div class="col-md-8">
                                                                                    <div class="demo-radio-button">
                                                                                        <input name="poste_risque" type="radio" id="radio_13" value="Oui" {{ $employe->poste_risque == 'Oui' ? 'checked' : ''}}>
                                                                                        <label for="radio_13">Oui</label>
                                                                                        <input name="poste_risque" type="radio" id="radio_14" value="Non" {{ $employe->poste_risque == 'Non' ? 'checked' : ''}}>
                                                                                        <label for="radio_14">Non</label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <div class="col-md-4">
                                                                                    <label style="margin-top: 10px">Visite d'Embauche</label>
                                                                                </div>
                                                                                <div class="col-md-8">
                                                                                    <div class="demo-radio-button">
                                                                                        <input name="visite_embauche" type="radio" id="radio_15" value="Oui" {{ $employe->visite_embauche == 'Oui' ? 'checked' : ''}}>
                                                                                        <label for="radio_15">Oui</label>
                                                                                        <input name="visite_embauche" type="radio" id="radio_16" value="Non" {{ $employe->visite_embauche == 'Non' ? 'checked' : ''}}>
                                                                                        <label for="radio_16">Non</label>
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
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <a href="#supp{{ $employe->id }}Modal" type="button" data-toggle="modal" title="Supprimer" class="btn bg-red btn-circle waves-effect waves-circle waves-float">
                                                    <i class="material-icons">delete_forever</i>
                                                </a>
                                                <div class="modal fade" id="supp{{$employe->id }}Modal" tabindex="-1" role="dialog" aria-labelledby="supp{{ $employe->id }}ModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body text-center">
                                                                Voulez-vous vraiment supprimer cette employé? 
                                                            </div>
                                                            <div class="modal-footer">
                                                                <form class="form-inline" action="{{ url('/employes/'.$employe->id)}}"  method="POST">
                                                                    @method('DELETE')
                                                                    @csrf
                                                                    <button type="button" class="btn btn-light" data-dismiss="modal" style="margin-bottom: 0px">Non</button>
                                                                    <button type="submit" class="btn btn-danger" style="margin-top: 0px">Oui</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
    <div class="modal-dialog" role="document">
        <form action="{{url('employes')}}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="largeModalLabel">Nouvel employé</h4>
                </div>
                <div class="modal-body">
                    
                    <div class="row clearfix" style="margin-top: 30px">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="matricule" placeholder="Matricule">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="nom" placeholder="Nom et prénom">
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label style="margin-top: 10px">Sexe</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="demo-radio-button">
                                        <input name="sexe" type="radio" id="radio_1" value="Homme" checked="">
                                        <label for="radio_1">Homme</label>
                                        <input name="sexe" type="radio" id="radio_2" value="Femme">
                                        <label for="radio_2">Femme</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-line">
                                <select name="fonction" class="form-control show-tick" required>
                                    <option value="">-- Selectionnez une fonction --</option>
                                    @foreach ($fonctions as $fct)
                                    <option value="{{$fct->intitule}}">{{$fct->intitule}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group row" style="margin-top: 10px">
                                <div class="col-md-4">
                                    <label style="margin-top: 10px">Statut</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="demo-radio-button">
                                        <input name="statut" type="radio" id="radio_7" value="Actif" checked="">
                                        <label for="radio_7">Actif</label>
                                        <input name="statut" type="radio" id="radio_8" value="Non actif">
                                        <label for="radio_8">Non actif</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label style="margin-top: 10px">Date de naissance</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-line">
                                        <input type="date" name="date_naissance" class="form-control date" placeholder="Ex: 30/07/2016">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label style="margin-top: 10px">Date de recrutement</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-line">
                                        <input type="date" name="date_rec" class="form-control date" placeholder="Ex: 30/07/2016">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="affectation" placeholder="Affectation">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label style="margin-top: 10px">Poste à risque</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="demo-radio-button">
                                        <input name="poste_risque" type="radio" id="radio_3" value="Oui" checked="">
                                        <label for="radio_3">Oui</label>
                                        <input name="poste_risque" type="radio" id="radio_4" value="Non">
                                        <label for="radio_4">Non</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label style="margin-top: 10px">Visite d'Embauche</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="demo-radio-button">
                                        <input name="visite_embauche" type="radio" id="radio_5" value="Oui" checked="">
                                        <label for="radio_5">Oui</label>
                                        <input name="visite_embauche" type="radio" id="radio_6" value="Non">
                                        <label for="radio_6">Non</label>
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
            </div>
        </form>
    </div>
</div>
{{-- <div class="modal fade" id="nv_e" tabindex="-1" role="dialog">
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
</div> --}}
</section>

@endsection