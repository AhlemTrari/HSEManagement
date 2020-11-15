@extends('layouts.datatable')

@section('titre')
<title>Médcine de travail | APMC Divindus</title>
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
                        <li class="active">
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
                    <div class="col-md-4"></div>
                    <div class="col-md-4 clearfix demo-button-sizes">
                        @if (! Auth::user()->is_admin)
                            <button type="button" class="btn bg-teal btn-block btn-lg waves-effect" data-toggle="modal" data-target="#canevas">Nouveau canevas</button>
                        @endif
                    </div>
                    <div class="col-md-4 col-lg-4" style="float: right">
                        <a href="#" type="button" target="_blank" class="btn bg-teal btn-block btn-lg waves-effect dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            Exporter le canevas annuel <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="{{url('/MedcineDeTravail/exportAnnuel/'.$year)}}" target="_blank" class=" waves-effect waves-block">Excel</a></li>
                            {{-- <li><a href="" target="_blank" class=" waves-effect waves-block">PDF</a></li> --}}
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>
                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                    <div class="card">
                        <div class="body">
                            <div class="table-responsive">

                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 50%"></th>
                                            <th>Nombre</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">Visite d'embauche</th>
                                            <td>{{ $visite_embauche }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Visite periodique</th>
                                            <td>{{ $visite_periodique }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Radiographie</th>
                                            <td>{{ $radiographie }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Examen biologique</th>
                                            <td>{{ $examen_bio }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Aménagements du poste</th>
                                            <td>{{ $amenagements}}</td>
                                        </tr>
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
                               Canevas de médcine de travail par mois:
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">

                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>Intitulé</th>
                                            @if (Auth::user()->is_admin)
                                                <th>Unité</th>
                                            @endif
                                            <th>Mois</th>
                                            <th>Année</th>
                                            <th style="width: 18%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($canevas as $caneva)
                                        <tr>
                                            <td>Canevas de médcine de travail {{$caneva->year}}</td>
                                            @if (Auth::user()->is_admin)
                                                @if ($caneva->unite == 1)
                                                    <td>Unité Terga</td>
                                                @else
                                                    <td>Unité Hennaya</td>
                                                @endif
                                            @endif
                                            <td >{{$caneva->mois}}</td>
                                            <td >{{$caneva->year}}</td>
                                            <td >
                                                <div class="icon-button-demo">
                                                    <a href="{{url('MedcineDeTravail/mois/'.$caneva->mois.'/'.$caneva->year)}}" title="Détails" type="button" class="btn bg-cyan btn-circle waves-effect waves-circle waves-float">
                                                        <i class="material-icons">visibility</i>
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

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                               Canevas de médcine de travail par trimestre:
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">

                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>Intitulé</th>
                                            @if (Auth::user()->is_admin)
                                                <th>Unité</th>
                                            @endif
                                            <th>Trimestre</th>
                                            <th>Année</th>
                                            <th style="width: 18%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($canevasT as $caneva)
                                        <tr>
                                            <td>Canevas de médcine de travail {{$caneva->year}} {{$caneva->trimestre}}</td>
                                            @if (Auth::user()->is_admin)
                                                @if ($caneva->unite == 1)
                                                    <td>Unité Terga</td>
                                                @else
                                                    <td>Unité Hennaya</td>
                                                @endif
                                            @endif
                                            <td >{{$caneva->trimestre}}</td>
                                            <td >{{$caneva->year}}</td>
                                            <td >
                                                <div class="icon-button-demo">
                                                    <a href="{{url('MedcineDeTravail/trimestre/'.$caneva->trimestre.'/'.$caneva->year)}}" type="button" title="Détails" class="btn bg-cyan btn-circle waves-effect waves-circle waves-float">
                                                        <i class="material-icons">visibility</i>
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
            
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                               Canevas de médcine de travail par semestre:
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">

                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>Intitulé</th>
                                            @if (Auth::user()->is_admin)
                                                <th>Unité</th>
                                            @endif
                                            <th>Semestre</th>
                                            <th>Année</th>
                                            <th style="width: 18%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($canevasS as $caneva)
                                        <tr>
                                            <td>Canevas de médcine de travail {{$caneva->year}} {{$caneva->semestre}}</td>
                                            @if (Auth::user()->is_admin)
                                                @if ($caneva->unite == 1)
                                                    <td>Unité Terga</td>
                                                @else
                                                    <td>Unité Hennaya</td>
                                                @endif
                                            @endif
                                            <td >{{$caneva->semestre}}</td>
                                            <td >{{$caneva->year}}</td>
                                            <td >
                                                <div class="icon-button-demo">
                                                    <a href="{{url('MedcineDeTravail/semestre/'.$caneva->semestre.'/'.$caneva->year)}}" type="button" title="Détails" class="btn bg-cyan btn-circle waves-effect waves-circle waves-float">
                                                        <i class="material-icons">visibility</i>
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

            {{-- @include('HSE.Mt.table',$canevasExport) --}}
        </div>
    </section>

    <div class="modal fade" id="canevas" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form action="{{url('/MedcineDeTravail')}}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="largeModalLabel">Canevas de medecine da travail</h4>
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
                        
                        <div class="row clearfix" style="margin-top: 30px">
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label style="margin-top: 10px">Date de visite periodique</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-line">
                                            <input type="date" name="periodique" class="form-control date" placeholder="Ex: 30/07/2016" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label style="margin-top: 10px">Date du radiographie</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-line">
                                            <input type="date" name="radiographie" class="form-control date" placeholder="Ex: 30/07/2016">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label style="margin-top: 10px">Date d'examen biologique</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-line">
                                            <input type="date" name="examen_bio" class="form-control date" placeholder="Ex: 30/07/2016">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-line">
                                        <textarea rows="1" name="observation" class="form-control no-resize auto-growth" placeholder="Observation..." style="overflow: hidden; overflow-wrap: break-word; height: 46px;"></textarea>
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
    
 @endsection