@extends('layouts.datatable')

@section('titre')
<title>Aménagements des postes | APMC Divindus</title>
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
                <li class="active">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <span>Médecine de travail</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="{{url('/MedcineDeTravail')}}" >
                                <span>Canevas de médecine de travail</span>
                            </a>
                        </li>
                        <li class="active">
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
                        @if (! Auth::user()->is_admin)
                            <button type="button" class="btn bg-teal btn-block btn-lg waves-effect" data-toggle="modal" data-target="#canevas">Nouvel aménagement du poste</button>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                               Liste des aménagements des poste:
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>Employé</th>
                                            @if (Auth::user()->is_admin)
                                                <th>Unité</th>
                                            @endif
                                            <th>Ancien poste</th>
                                            <th>Nouveau poste</th>
                                            <th>Date de visite après changement</th>
                                            <th style="width: 10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($amenagements as $amenagement)
                                        <tr>
                                            <td>
                                                <a href="{{ url('/employes/profil/'.$amenagement->employe_id) }}">{{$amenagement->employe->nom}}</a>
                                            </td>
                                            @if (Auth::user()->is_admin)
                                                @if ($amenagement->employe->unite == 1)
                                                    <td>Unité Terga</td>
                                                @else
                                                    <td>Unité Hennaya</td>
                                                @endif
                                            @endif
                                            <td >{{$amenagement->old_post}}</td>
                                            <td >{{$amenagement->new_post}}</td>
                                            <td >
                                                @if ($amenagement->visite)
                                                {{$amenagement->date}} 
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td >
                                                <div class="icon-button-demo">
                                                    <a href="#supp{{ $amenagement->id }}Modal" type="button" data-toggle="modal" title="Supprimer" class="btn bg-red btn-circle waves-effect waves-circle waves-float">
                                                        <i class="material-icons">delete_forever</i>
                                                    </a>
                                                    <div class="modal fade" id="supp{{$amenagement->id }}Modal" tabindex="-1" role="dialog" aria-labelledby="supp{{ $amenagement->id }}ModalLabel" aria-hidden="true">
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
                                                                    <form class="form-inline" action="{{ url('/AmenagementPost/'.$amenagement->id)}}"  method="POST">
                                                                        @method('DELETE')
                                                                        @csrf
                                                                        <button type="button" class="btn btn-light" data-dismiss="modal" style="margin-bottom: 0px">Non</button>
                                                                        <button type="submit" class="btn btn-danger" style="margin-top: 0px">Oui</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
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
    <div class="modal fade" id="canevas" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form action="{{url('/AmenagementPost')}}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="largeModalLabel">Nouvel amenagement du poste</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-line">
                                    <select name="employe_id" class="form-control show-tick" required>
                                        <option value="">-- Selectionnez un employé --</option>
                                        @foreach ($employes as $employe)
                                        <option value="{{$employe->id}}">{{$employe->matricule}} - {{$employe->nom}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-line"  style="margin-top: 30px">
                            <select name="new_post" class="form-control show-tick" required>
                                <option value="">-- Nouveau poste --</option>
                                @foreach ($fonctions as $fct)
                                <option value="{{$fct->intitule}}">{{$fct->intitule}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-line row"  style="margin-top: 30px">
                            <div class="col-md-5">
                                <label style="margin-top: 10px">visite après changement</label>
                            </div>
                            <div class="col-md-7">
                                <div class="demo-radio-button">
                                    <input name="visite" type="radio" id="radio_1" value="1" checked="">
                                    <label for="radio_1">Oui</label>
                                    <input name="visite" type="radio" id="radio_2" value="0" onclick="javascript:visite();">
                                    <label for="radio_2">Non</label>
                                </div>
                            </div>
                        </div>
                        <div id="date_visite" class="row clearfix" style="margin-top: 30px">
                            <div class="col-sm-12">
                                <div class="form-group row" >
                                    <div class="col-md-4">
                                        <label style="margin-top: 10px">Date de visite (Si oui) </label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-line">
                                            <input type="date" name="date" class="form-control date" placeholder="Ex: 30/07/2016">
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

    <script type="text/javascript">
        function visite() {
            if (document.getElementById('radio_2').checked) {
                document.getElementById('date_visite').style.display = 'none';
            }
        }
    </script>
 @endsection