@extends('layouts.datatable')

@section('titre')
<title>S.M.HSE | APMC Divindus</title>
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
        <li class="active" >
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
                <li class="active">
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
                <div class="card">
                    <div class="header">
                        <h2>
                            Manuel :
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th>Intitulé</th>
                                        <th>Indice de révision</th>
                                        @if ( Auth::user()->is_admin)
                                        <th>Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($manuels as $manuel)
                                    <tr>
                                        <td>{{$manuel->code}}</td>
                                        <td><a href="{{url($manuel->file)}}" target="_blanck">{{$manuel->intitule}}</a></td>
                                        <td>{{$manuel->indice_revision}}</td>
                                        @if ( Auth::user()->is_admin)
                                        <td >
                                            <div class="icon-button-demo">
                                                <a href="#supp{{ $manuel->id }}Modal" type="button" data-toggle="modal" class="btn bg-red btn-circle waves-effect waves-circle waves-float">
                                                    <i class="material-icons">delete_forever</i>
                                                </a>
                                                <div class="modal fade" id="supp{{$manuel->id }}Modal" tabindex="-1" role="dialog" aria-labelledby="supp{{ $manuel->id }}ModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body text-center">
                                                                Voulez-vous vraiment supprimer cette ligne? 
                                                            </div>
                                                            <div class="modal-footer">
                                                                <form class="form-inline" action="{{ url('S_M_HSE/'.$manuel->id)}}"  method="POST">
                                                                    @method('DELETE')
                                                                    @csrf
                                                                    <button type="button" class="btn btn-light" data-dismiss="modal">Non</button>
                                                                    <button type="submit" class="btn btn-danger">Oui</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </td>
                                        @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Procédures :
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th>Intitulé</th>
                                        <th>Indice de révision</th>
                                        @if ( Auth::user()->is_admin)
                                        <th>Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($procedures as $procedure)
                                    <tr>
                                        <td>{{$procedure->code}}</td>
                                        <td><a href="{{url($procedure->file)}}" target="_blanck">{{$procedure->intitule}}</a></td>
                                        <td>{{$procedure->indice_revision}}</td>
                                        @if ( Auth::user()->is_admin)
                                        <td >
                                            <div class="icon-button-demo">
                                                <a href="#supp{{ $procedure->id }}Modal" type="button" data-toggle="modal" class="btn bg-red btn-circle waves-effect waves-circle waves-float">
                                                    <i class="material-icons">delete_forever</i>
                                                </a>
                                                <div class="modal fade" id="supp{{$procedure->id }}Modal" tabindex="-1" role="dialog" aria-labelledby="supp{{ $procedure->id }}ModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body text-center">
                                                                Voulez-vous vraiment supprimer cette ligne? 
                                                            </div>
                                                            <div class="modal-footer">
                                                                <form class="form-inline" action="{{ url('S_M_HSE/'.$procedure->id)}}"  method="POST">
                                                                    @method('DELETE')
                                                                    @csrf
                                                                    <button type="button" class="btn btn-light" data-dismiss="modal">Non</button>
                                                                    <button type="submit" class="btn btn-danger">Oui</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </td>
                                        @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Instructions :
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th>Intitulé</th>
                                        <th>Indice de révision</th>
                                        @if ( Auth::user()->is_admin)
                                        <th>Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($instructions as $instruction)
                                    <tr>
                                        <td>{{$instruction->code}}</td>
                                        <td><a href="{{url($instruction->file)}}" target="_blanck">{{$instruction->intitule}}</a></td>
                                        <td>{{$instruction->indice_revision}}</td>
                                        @if ( Auth::user()->is_admin)
                                        <td >
                                            <div class="icon-button-demo">
                                                <a href="#supp{{ $instruction->id }}Modal" type="button" data-toggle="modal" class="btn bg-red btn-circle waves-effect waves-circle waves-float">
                                                    <i class="material-icons">delete_forever</i>
                                                </a>
                                                <div class="modal fade" id="supp{{$instruction->id }}Modal" tabindex="-1" role="dialog" aria-labelledby="supp{{ $instruction->id }}ModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body text-center">
                                                                Voulez-vous vraiment refuser cette proposition ? 
                                                            </div>
                                                            <div class="modal-footer">
                                                                <form class="form-inline" action="{{ url('S_M_HSE/'.$instruction->id)}}"  method="POST">
                                                                    @method('DELETE')
                                                                    @csrf
                                                                    <button type="button" class="btn btn-light" data-dismiss="modal">Non</button>
                                                                    <button type="submit" class="btn btn-danger">Oui</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Enregistrements :
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th>Intitulé</th>
                                        <th>Indice de révision</th>
                                        @if ( Auth::user()->is_admin)
                                        <th>Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($enregistrements as $enregistrement)
                                    <tr>
                                        <td>{{$enregistrement->code}}</td>
                                        <td><a href="{{url($enregistrement->file)}}" target="_blanck">{{$enregistrement->intitule}}</a></td>
                                        <td>{{$enregistrement->indice_revision}}</td>
                                        @if ( Auth::user()->is_admin)
                                        <td >
                                            <div class="icon-button-demo">
                                                <a href="#supp{{ $enregistrement->id }}Modal" type="button" data-toggle="modal" class="btn bg-red btn-circle waves-effect waves-circle waves-float">
                                                    <i class="material-icons">delete_forever</i>
                                                </a>
                                                <div class="modal fade" id="supp{{$enregistrement->id }}Modal" tabindex="-1" role="dialog" aria-labelledby="supp{{ $enregistrement->id }}ModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body text-center">
                                                                Voulez-vous vraiment refuser cette proposition ? 
                                                            </div>
                                                            <div class="modal-footer">
                                                                <form class="form-inline" action="{{ url('S_M_HSE/'.$enregistrement->id)}}"  method="POST">
                                                                    @method('DELETE')
                                                                    @csrf
                                                                    <button type="button" class="btn btn-light" data-dismiss="modal">Non</button>
                                                                    <button type="submit" class="btn btn-danger">Oui</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        @endif
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