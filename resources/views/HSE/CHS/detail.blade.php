
@extends('layouts.datatable')

@section('titre')
<title>Commission d'unité Hygiène et Sécurité | APMC Divindus</title>
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
                <li>
                    <a href="{{url('/MedcineDeTravail')}}" >
                        <span>Médecine de travail</span>
                    </a>
                </li>
                <li class="active">
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
                        <button type="button" class="btn bg-teal btn-block btn-lg waves-effect" data-toggle="modal" data-target="#commission">Nouvelle commission</button>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                           Commission d'unité Hygiène et Sécurité :
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>Intitulé</th>
                                        <th>date</th>
                                        @if (Auth::user()->is_admin)
                                            <th>Unité</th>
                                        @endif
                                        <th style="width: 25%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($commissions as $commission)
                                    <tr>
                                        <td>{{$commission->intitule}}</td>
                                        <td>{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $commission->date)->format('m-Y')}}</td>
                                        @if (Auth::user()->is_admin)
                                            @if ($commission->unite == 1)
                                                <td>Unité Terga</td>
                                            @else
                                                <td>Unité Hennaya</td>
                                            @endif
                                        @endif
                                        <td >
                                            <div class="icon-button-demo">
                                                <a href="#show{{ $commission->id }}Modal" type="button" data-toggle="modal" title="Détails" class="btn bg-cyan btn-circle waves-effect waves-circle waves-float">
                                                    <i class="material-icons">visibility</i>
                                                </a>
                                                <div class="modal fade" id="show{{ $commission->id }}Modal" tabindex="-1" role="dialog">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="largeModalLabel">Commission d'unité Hygiène et Sécurité</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <b> Intitulé </b>
                                                                    </div>
                                                                    <div class="content col-md-6">
                                                                        {{$commission->intitule}}
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <b> Date de commission </b>
                                                                    </div>
                                                                    <div class="content col-md-6">
                                                                        {{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $commission->date)->format('m-Y')}}
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <b> PV de la CHS </b>
                                                                    </div>
                                                                    <div class="content col-md-6">
                                                                        <a href="{{$commission->file1}}" target="_blanck">Cliquer ici</a>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <b> Nombre de réunions CHS </b>
                                                                    </div>
                                                                    <div class="content col-md-6">
                                                                        {{$commission->reunions_chs}}
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <b> Nombre de réunions CHS extraordinaire </b>
                                                                    </div>
                                                                    <div class="content col-md-6">
                                                                        {{$commission->reunions_extra}}
                                                                    </div>
                                                                </div>
                                                                @if ($commission->reunions_extra)
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <b> PV de la CHS extraordinaire</b>
                                                                    </div>
                                                                    <div class="content col-md-6">
                                                                        <a href="{{$commission->file2}}" target="_blanck">Cliquer ici</a>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <b> Nombre d'enquêtes menées par la CHS </b>
                                                                    </div>
                                                                    <div class="content col-md-6">
                                                                        {{$commission->nbr_enquete}}
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <b> Nombre de cas de recours à un expert </b>
                                                                    </div>
                                                                    <div class="content col-md-6">
                                                                        {{$commission->cas_recours}}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <a href="{{$commission->merger}}" target="_blanck" type="button" title="Détails" class="btn bg-green btn-circle waves-effect waves-circle waves-float">
                                                    <i class="material-icons">file_download</i>
                                                </a>
                                                @if ( !Auth::user()->is_admin)
                                                    <a href="#edit{{ $commission->id }}Modal" type="button" data-toggle="modal" title="Modifier" class="btn bg-grey btn-circle waves-effect waves-circle waves-float">
                                                        <i class="material-icons">edit</i>
                                                    </a>
                                                    <div class="modal fade" id="edit{{ $commission->id }}Modal" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <form action="{{url('/CommissionHygieneSecurite/'.$commission->id)}}" method="POST" enctype="multipart/form-data">
                                                                <input type="hidden" name="_method" value="PUT">
                                                                {{ csrf_field() }}
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title" id="largeModalLabel">Modifier commission d'unité Hygiene et Securite</h4>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        
                                                                        <div class="row clearfix" style="margin-top: 30px">
                                                                            <div class="col-sm-12">
                                                                                <div class="form-group">
                                                                                    <div class="form-line">
                                                                                        <input type="text" name="intitule" class="form-control" value="{{$commission->intitule}}" required>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row" style="margin-top: 10px" >
                                                                                    <div class="col-md-4">
                                                                                        <label style="margin-top: 10px">Date de commission</label>
                                                                                    </div>
                                                                                    <div class="col-md-8">
                                                                                        <div class="form-line">
                                                                                            <input type="month" name="date" class="form-control date" value="{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $commission->date)->format('Y-m')}}" required>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-md-6 " style="margin-top: 10px" >
                                                                                        <div class="form-group">
                                                                                            <label>PV de la CHS</label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group">
                                                                                            <div class="form-line">
                                                                                                <input id="upload" name="file1" class="file-upload__input" type="file" accept="application/pdf">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-md-6 " style="margin-top: 10px" >
                                                                                        <div class="form-group">
                                                                                            <label>Nombre de réunions CHS</label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group">
                                                                                            <div class="form-line">
                                                                                                <input type="number" name="reunions_chs" class="form-control text-center" value="{{$commission->reunions_chs}}" required>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-md-6 " style="margin-top: 10px" >
                                                                                        <div class="form-group">
                                                                                            <label>Nombre de réunions CHS extraordinaire</label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group">
                                                                                            <div class="form-line">
                                                                                                <input id="reunions_extra_edit" type="number" name="reunions_extra" class="form-control text-center" value="{{$commission->reunions_extra}}" required>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div id="file2edit" class="row" style="display: none">
                                                                                    <div class="col-md-6 " style="margin-top: 10px" >
                                                                                        <div class="form-group">
                                                                                            <label>PV de la CHS extraordinaire</label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group" >
                                                                                            <div class="form-line">
                                                                                                <input id="upload" name="file2" class="file-upload__input" type="file" accept="application/pdf">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-md-6 " style="margin-top: 10px" >
                                                                                        <div class="form-group">
                                                                                            <label>Nombre d'enquêtes menées par la CHS</label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group">
                                                                                            <div class="form-line">
                                                                                                <input type="number" name="nbr_enquete" class="form-control text-center" value="{{$commission->nbr_enquete}}" required>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-md-6 " style="margin-top: 10px" >
                                                                                        <div class="form-group">
                                                                                            <label>Nombre de cas de recours à un expert</label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group">
                                                                                            <div class="form-line">
                                                                                                <input type="number" name="cas_recours" class="form-control text-center" value="{{$commission->cas_recours}}" required>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="submit" class="btn btn-link waves-effect" style="margin-bottom: 0px" >Valider</button>
                                                                        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal" style="margin-top: 0px" >Annuler</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <a href="#supp{{ $commission->id }}Modal" type="button" data-toggle="modal" title="Supprimer" class="btn bg-red btn-circle waves-effect waves-circle waves-float">
                                                        <i class="material-icons">delete_forever</i>
                                                    </a>
                                                    <div class="modal fade" id="supp{{$commission->id }}Modal" tabindex="-1" role="dialog" aria-labelledby="supp{{ $commission->id }}ModalLabel" aria-hidden="true">
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
                                                                    <form class="form-inline" action="{{ url('CommissionHygieneSecurite/'.$commission->id)}}"  method="POST">
                                                                        @method('DELETE')
                                                                        @csrf
                                                                        <button type="button" class="btn btn-light" data-dismiss="modal" style="margin-bottom:0px">Non</button>
                                                                        <button type="submit" class="btn btn-danger" style="margin-top:0px" >Oui</button>
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
</section>
<div class="modal fade" id="commission" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form action="{{url('/CommissionHygieneSecurite')}}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="largeModalLabel">Nouvelle commission d'unité Hygiene et Securite</h4>
                </div>
                <div class="modal-body">
                    
                    <div class="row clearfix" style="margin-top: 30px">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="intitule" class="form-control" placeholder="Intitulé" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label style="margin-top: 10px">Date de commission</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-line">
                                        <input type="month" name="date" class="form-control date" placeholder="Ex: 30/07/2016" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 " style="margin-top: 10px" >
                                    <div class="form-group">
                                        <label>PV de la CHS</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input id="upload" name="file1" class="file-upload__input" type="file" accept="application/pdf" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 " style="margin-top: 10px" >
                                    <div class="form-group">
                                        <label>Nombre de réunions CHS</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="number" name="reunions_chs" class="form-control text-center" value="0" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 " style="margin-top: 10px" >
                                    <div class="form-group">
                                        <label>Nombre de réunions CHS extraordinaire</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input id="reunions_extra" type="number" name="reunions_extra" class="form-control text-center" value="0" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="file2" class="row" style="display: none">
                                <div class="col-md-6 " style="margin-top: 10px" >
                                    <div class="form-group">
                                        <label>PV de la CHS extraordinaire</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group" >
                                        <div class="form-line">
                                            <input id="upload" name="file2" class="file-upload__input" type="file" accept="application/pdf">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 " style="margin-top: 10px" >
                                    <div class="form-group">
                                        <label>Nombre d'enquêtes menées par la CHS</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="number" name="nbr_enquete" class="form-control text-center" value="0" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 " style="margin-top: 10px" >
                                    <div class="form-group">
                                        <label>Nombre de cas de recours à un expert</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="number" name="cas_recours" class="form-control text-center" value="0" required>
                                        </div>
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
{{-- <script type="text/javascript">
function file2() {
    if(document.getElementById("reunions_extra").value == "1"){
    document.getElementById("file2").style.display="block";
    }
}
</script> --}}
@endsection
