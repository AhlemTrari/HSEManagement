@extends('layouts.master1')

@section('titre')
<title>Déclarations d'Accident de Matériel | APMC Divindus</title>
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
                <li class="active">
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
            <form action="{{url('/DeclarationAccidentM')}}" method="POST">
            {{ csrf_field() }}
                <div class="row">
                    <div class="card">
                        <div class="header bg-blue-grey">
                            <center>
                            <h2>
                                Identité du Responsable d’Accident
                            </h2>
                            </center>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-sm-offset-1 col-sm-10 " style="padding-top: 20px">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <select name="employe_id" class="form-control show-tick" required>
                                                <option value="">-- Selectionnez un employé --</option>
                                                @foreach ($employes as $employe)
                                                <option value="{{$employe->id}}">{{$employe->matricule}} - {{$employe->nom}} {{$employe->prenom}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="row clearfix">
                                <div class="col-sm-offset-1 col-sm-5">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control">
                                            <label class="form-label">Nom</label>
                                        </div>
                                    </div>
                                </div>
                                <div class=" col-sm-5">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control">
                                            <label class="form-label">Prénom</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-offset-1 col-sm-5">
                                    <div class="form-group">
                                        <div class="form-line" id="bs_datepicker_container">
                                            <input type="text" class="form-control" placeholder="Date de naissance ">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <div class="form-line" id="bs_datepicker_container">
                                            <input type="text" class="form-control" placeholder="Date de recrutement">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-offset-1 col-sm-5">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control">
                                            <label class="form-label">Qualification professionnelle</label>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="card">
                        <div class="header bg-light-green"> 
                            <!-- bg-light-blue -->
                            <center>
                            <h2>
                                Accident
                            </h2>
                            </center>
                        </div>
                        
                        <div class="body">                   
                            <div class="row clearfix">
                                <div class="col-sm-offset-1 col-sm-5">
                                    <div class="form-group ">
                                        <div class="form-line">
                                            <label class="form-label">L’accident à t-il fait d’autres victimes ?</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="demo-radio-button">
                                        <input name="autre_victimes" type="radio" id="radio_7" class="radio-col-teal" value="1"/>
                                        <label for="radio_7">Oui</label>
                                        <input name="autre_victimes" type="radio" id="radio_8" class="radio-col-teal" value="0" checked/>
                                        <label for="radio_8">Non</label>
                                        </div>
                                </div>
                                <div class="col-sm-offset-1 col-sm-10">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="chantier" required>
                                            <label class="form-label">Site (chantier)</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-offset-1 col-sm-10">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="lieu" required>
                                            <label class="form-label">Lieu exact de l’accident</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-offset-1 col-sm-10">
                                    <div class="form-group">
                                        <div class="form-line" id="bs_datepicker_container">
                                            <input type="text" class="form-control" placeholder="Date" name="date" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-offset-1 col-sm-10">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="timepicker form-control" placeholder="Heure" name="heure" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-offset-1 col-sm-10">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <textarea rows="1" class="form-control no-resize auto-growth" placeholder="Que faisait la victime au moment de l’accident ?" name="travail_courrant" required></textarea>
                                        </div>
                                    </div>
                                </div> 
                                <div class="col-sm-offset-1 col-sm-10">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="materiel" required>
                                            <label class="form-label">Eléments matériels à l’origine de l’accident</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                
                <div class="row">
                    <div class="card">
                        <div class="header bg-blue-grey"> 
                            <!-- bg-light-blue -->
                            <center>
                            <h2>
                                Causes de l'accident
                            </h2>
                            </center>
                        </div>
                        <div class="body">
                            <div class="row">
                                <div class="col-sm-offset-1 col-sm-5">
                                    <div class="form-group">
                                        <center><label> Directes </label></center>
                                        <div class="form-line">
                                            <textarea rows="1" name="cause_direct" required class="form-control no-resize auto-growth" placeholder="Causes directes"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <center><label> Indirectes </label></center>
                                        <div class="form-line">
                                            <textarea rows="1" name="cause_indirect" class="form-control no-resize auto-growth" placeholder="Causes indirectes"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-offset-1 col-sm-10">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <textarea rows="1" class="form-control no-resize auto-growth" name="consequences" required placeholder="Conséquences"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-offset-1 col-sm-5">
                                    <div class="form-group ">
                                        <div class="form-line">
                                            <label class="form-label">L’accident a-t-il été causé par un tiers ?</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="demo-radio-button">
                                        <input name="if_tiers" type="radio" id="radio_4" class="radio-col-teal" onclick="javascript:coordonnees();" value="1"/>
                                        <label for="radio_4">Oui</label>
                                        <input name="if_tiers" type="radio" id="radio_5" class="radio-col-teal" onclick="javascript:coordonnees();" value="0"/>
                                        <label for="radio_5">Non</label>
                                        </div>
                                </div>
                                <div id="tiers">
                                    <div class="col-sm-offset-2">
                                        <label> Coordonnées du tiers </label>
                                    </div>
                                    <div class="col-sm-offset-1 col-sm-5">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="tiers_nom">
                                                <label class="form-label">Nom</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" col-sm-5">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="tiers_prenom">
                                                <label class="form-label">Prénom</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-offset-1 col-sm-5">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="tiers_adress">
                                                <label class="form-label">Adresse</label>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="card">
                        <div class="header bg-light-green">
                            <center>
                            <h2>
                                Témoins
                            </h2>
                            </center>
                        </div>
                        <div class="body">
                            <div class="row">
                                <div class="col-sm-offset-1 col-sm-10">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <textarea rows="1" class="form-control no-resize auto-growth" name="temoins" required placeholder="Nom et prénom des témoins"></textarea>
                                        </div>
                                    </div>
                                </div> 
                                <div class="col-sm-offset-1 col-sm-5">
                                    <div class="form-group ">
                                        <div class="form-line">
                                            <label class="form-label">Existe-t-il une constatation de police ?</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="demo-radio-button">
                                        <input name="if_constatation_police" type="radio" id="radio_2" value="1" class="radio-col-teal" onclick="javascript:constatation();"/>
                                        <label for="radio_2">Oui</label>
                                        <input name="if_constatation_police" type="radio" id="radio_3" value="0" class="radio-col-teal" onclick="javascript:constatation();"/>
                                        <label for="radio_3">Non</label>
                                    </div>
                                </div>
                                <div class="col-sm-offset-1 col-sm-5" id="constatation" style="display: none;">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="constatation_police">
                                            <label class="form-label">Laquelle / où?</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="card">
                        <div class="header bg-blue-grey">
                            <center>
                            <h2>
                                Circonstances détaillées de l’accident
                            </h2>
                            </center>
                        </div>
                        <div class="body">
                            <div class="row">
                                <div class="col-sm-offset-1 col-sm-10">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <textarea rows="1" name="circonstances_detaillees" required class="form-control no-resize auto-growth" placeholder="Circonstances détaillées de l’accident"></textarea>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix demo-button-sizes">
                    <div class="col-md-offset-8 col-md-2">
                        <a href="{{url('/DeclarationAccidentM')}}" type="button" class="btn btn-default btn-block btn-lg waves-effect">Annuler</a>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn bg-teal btn-block btn-lg waves-effect">Valider</button>
                    </div>
                </div>
            </form>
            <div class="row">
                <br/><br/>
            </div>
        </div>
    </section>
@endsection