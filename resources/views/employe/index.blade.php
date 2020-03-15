@extends('layouts.app')

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
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
                <div class="card">
                    <div class="body">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs tab-nav-right" role="tablist">
                            <li role="presentation" class="active"><a href="#all" data-toggle="tab">Tous les employés</a></li>
                            <li role="presentation"><a href="#uniteT" data-toggle="tab">Unité Targa</a></li>
                            <li role="presentation"><a href="#uniteH" data-toggle="tab">Unité Hennaya</a></li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">

                            <div role="tabpanel" class="tab-pane fade in active" id="all">
                                <div class="table-responsive">

                                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                        <thead>
                                            <tr>
                                                <th>Matricule</th>
                                                <th>Nom</th>
                                                <th>Unité</th>
                                                <th>date de recrutement</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                            @foreach($employes as $employe)
                                                <td></td>
                                                <td>{{$employe->nom}} {{$employe->prenom}}</td>
                                                <td>{{$employe->unite}}</td>
                                                <td>{{$employe->date_rec}}</td>
                                                <td>
                                                    <div class="icon-button-demo">
                                                        <a href="show1.html" type="button" class="btn bg-cyan btn-circle waves-effect waves-circle waves-float">
                                                            <i class="material-icons">details</i>
                                                        </a>
                                                        <a type="button" class="btn bg-light-green btn-circle waves-effect waves-circle waves-float">
                                                            <i class="material-icons">edit</i>
                                                        </a>
                                                        <a type="button" class="btn bg-red btn-circle waves-effect waves-circle waves-float">
                                                            <i class="material-icons">delete_forever</i>
                                                        </a>
                                                    </div>
                                                </td>
                                            @endforeach
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="uniteT">
                                <b>Profile Content</b>
                                <p>
                                    Lorem ipsum dolor sit amet, ut duo atqui exerci dicunt, ius impedit mediocritatem an. Pri ut tation electram moderatius.
                                    Per te suavitate democritum. Duis nemore probatus ne quo, ad liber essent aliquid
                                    pro. Et eos nusquam accumsan, vide mentitum fabellas ne est, eu munere gubergren
                                    sadipscing mel.
                                </p>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="uniteH">
                                <b>Settings Content</b>
                                <p>
                                    Lorem ipsum dolor sit amet, ut duo atqui exerci dicunt, ius impedit mediocritatem an. Pri ut tation electram moderatius.
                                    Per te suavitate democritum. Duis nemore probatus ne quo, ad liber essent aliquid
                                    pro. Et eos nusquam accumsan, vide mentitum fabellas ne est, eu munere gubergren
                                    sadipscing mel.
                                </p>
                            </div>
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

</section>

<div class="modal fade" id="nv_e" tabindex="-1" role="dialog" aria-labelledby="edit-my-poll-popup" aria-hidden="true">
    <div class="modal-dialog window-popup edit-my-poll-popup" role="document">
        <div class="modal-content">
            <a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close">
                <svg class="olymp-close-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-close-icon"></use></svg>
            </a>
            <div class="modal-body">

                

                <div class="edit-my-poll-content">
                
                    <form class="resume-form" method="POST" action="{{url('employes')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <fieldset>
                            <div class="form-group label-floating is-empty">
                                <label class="control-label">Matricule <span class="text-danger">*</span></label>
                                <input class="form-control" placeholder="" value="{{old('matricule')}}" type="text" name="matricule" required>
                            </div>
                            <div class="form-group label-floating is-empty">
                                <label class="control-label">Nom <span class="text-danger">*</span></label>
                                <input class="form-control" placeholder="" value="{{old('nom')}}" type="text" name="nom" required>
                            </div>
                            <div class="form-group label-floating is-empty">
                                <label class="control-label">Prénom <span class="text-danger">*</span></label>
                                <input class="form-control" placeholder="" value="{{old('prenom')}}" type="text" name="prenom" required>
                            </div>
                            <div class="form-group date-time-picker label-floating is-empty">
                                <label class="control-label">Date de naissance</label>
                                    <input type="date" value="" name="date_naissance"/>
                                    <span class="input-group-addon">
                                        <svg class="olymp-calendar-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-calendar-icon"></use></svg>
                                    </span>
                            </div>
                            <div class="form-group date-time-picker label-floating is-empty">
                                <label class="control-label">Date de recrutement</label>
                                    <input type="date" value="" name="date_rec"/>
                                    <span class="input-group-addon">
                                        <svg class="olymp-calendar-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-calendar-icon"></use></svg>
                                    </span>
                            </div>
                            
                        </fieldset>
                        <div class="row" style="padding-top: 30px; margin-left: 35%;">
                          <button class="close" type="button" data-dismiss="modal" aria-hidden="true"><i class="fa  fa-mail-reply"></i>Annuler &nbsp; &nbsp;</button>
                           <button type="submit" class=" btn btn-lg btn-primary"><i class="fa fa-check"></i> Valider</button> 
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection