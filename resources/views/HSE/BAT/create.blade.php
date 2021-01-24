@extends('layouts.master1')

@section('titre')
<title>Bilan des accidents de travail | APMC Divindus</title>
@endsection

@section('links')
    <!-- Bootstrap Spinner Css -->
    <link href="{{asset('assets/plugins/jquery-spinner/css/bootstrap-spinner.css')}}" rel="stylesheet">

    <!-- Bootstrap Select Css -->
    <link href="{{asset('assets/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" />
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
            <div class="block-header">
                <h2>
                    NOUVEAU BILAN DES ACCIDENTS DE TRAVAIL
                </h2>
            </div>
            <form method="POST" action="{{url('/BilanAccidentT')}}">
            {{ csrf_field() }}
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    Répartition des accidents de travail par moi :
                                </h2>
                            </div>
                            <div class="body">
                                <div class="row clearfix">
                                    <div class="col-md-6">
                                        <label class="form-label">Mois</label>
                                        <select name="mois" class="form-control show-tick" required>
                                            <option value="Janvier">Janvier</option>
                                            <option value="Fevrier">Février</option>
                                            <option value="Mars">Mars</option>
                                            <option value="Avril">Avril</option>
                                            <option value="Mai">Mai</option>
                                            <option value="Juin">Juin</option>
                                            <option value="Juillet">Juillet</option>
                                            <option value="Aout">Aout</option>
                                            <option value="Septembre">Septembre</option>
                                            <option value="Octobre">Octobre</option>
                                            <option value="Novembre">Novembre</option>
                                            <option value="Decembre">Décembre</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Année</label>
                                        <div class="input-group spinner" data-trigger="spinner" >
                                                <div class="form-line">
                                                    <input type="number" name="annee"  class="form-control text-center" placeholder="2000"  data-rule="quantity" min="2000" required>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Nbr accident de travail</label>
                                        <div class="input-group spinner" data-trigger="spinner" >
                                                <div class="form-line">
                                                    <input type="number" name="nbr_accidents"  class="form-control text-center"  data-rule="quantity" required>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Nbr journées perdues</label>
                                        <div class="input-group spinner" data-trigger="spinner">
                                            <div class="form-line">
                                                <input type="number" name="nbr_jours" class="form-control text-center"  data-rule="quantity" required>
                                            </div>
                                        </div>
                                    </div>
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
                                    Répartition des accidents de travail selon les jours de la semaine :
                                </h2>
                            </div>
                            <div class="body">
                                    <table id="" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Jours</th>
                                                <th>Dimanche</th>
                                                <th>Lundi</th>
                                                <th>Mardi</th>
                                                <th>Mercredi</th>
                                                <th>Jeudi</th>
                                                <th>Vendredi</th>
                                                <th>Samedi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Nbr d'accident sans arrêt</td>
                                                <td><input name="0acc" class="form-control text-center" type="number" required></td>
                                                <td><input name="1acc" class="form-control text-center" type="number" required></td>
                                                <td><input name="2acc" class="form-control text-center" type="number" required></td>
                                                <td><input name="3acc" class="form-control text-center" type="number" required></td>
                                                <td><input name="4acc" class="form-control text-center" type="number" required></td>
                                                <td><input name="5acc" class="form-control text-center" type="number" required></td>
                                                <td><input name="6acc" class="form-control text-center" type="number" required></td>
                                            </tr>
                                            <tr>
                                                <td>Nbr journées perdues</td>
                                                <td><input name="0jours" class="form-control text-center" type="number" required></td>
                                                <td><input name="1jours" class="form-control text-center"  type="number" required></td>
                                                <td><input name="2jours" class="form-control text-center" type="number" required></td>
                                                <td><input name="3jours" class="form-control text-center" type="number" required></td>
                                                <td><input name="4jours" class="form-control text-center" type="number" required></td>
                                                <td><input name="5jours" class="form-control text-center" type="number" required></td>
                                                <td><input name="6jours" class="form-control text-center" type="number" required></td>
                                            </tr>
                                        </tbody>
                                    </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    Répartition des accidents de travail par tranche d'horaires :
                                </h2>
                            </div>
                            <div class="body">
                                <table id="sum_table" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Tranches d'horaires</th>
                                            <th>Nbr d'accidents</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>6h à 8h</td>
                                            <td><input name="0accHeur" class="form-control text-center" type="number" required></td>
                                        </tr>
                                        <tr>
                                            <td>8h à 10h</td>
                                            <td><input name="1accHeur" class="form-control text-center"  type="number" required></td>
                                        </tr>
                                        <tr>
                                            <td>10h à 12h</td>
                                            <td><input name="2accHeur" class="form-control text-center"  type="number" required></td>
                                        </tr>
                                        <tr>
                                            <td>12h à 13h</td>
                                            <td><input name="3accHeur" class="form-control text-center"  type="number" required></td>
                                        </tr>
                                        <tr>
                                            <td>13h à 15h</td>
                                            <td><input name="4accHeur" class="form-control text-center"  type="number" required></td>
                                        </tr>
                                        <tr>
                                            <td>15h à 17h</td>
                                            <td><input name="5accHeur" class="form-control text-center"  type="number" required></td>
                                        </tr>
                                        <tr>
                                            <td>Autre</td>
                                            <td><input name="6accHeur" class="form-control text-center"  type="number" required></td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    Répartition des accidents de travail par siège des lésions :
                                </h2>
                            </div>
                            <div class="body">
                                <table id="sum_table" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Siège des lésions</th>
                                            <th>Nbr d'accidents</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Yeux</td>
                                            <td><input name="0accSiege" class="form-control text-center"  type="number" required></td>
                                        </tr>
                                        <tr>
                                            <td>Figure</td>
                                            <td><input name="1accSiege" class="form-control text-center"  type="number" required></td>
                                        </tr>
                                        <tr>
                                            <td>Tête</td>
                                            <td><input name="2accSiege" class="form-control text-center"  type="number" required></td>
                                        </tr>
                                        <tr>
                                            <td>Bassin</td>
                                            <td><input name="3accSiege" class="form-control text-center"  type="number" required></td>
                                        </tr>
                                        <tr>
                                            <td>Membres inférieurs</td>
                                            <td><input name="4accSiege" class="form-control text-center"  type="number" required></td>
                                        </tr>
                                        <tr>
                                            <td>Membres supérieurs</td>
                                            <td><input name="5accSiege" class="form-control text-center"  type="number" required></td>
                                        </tr>
                                        <tr>
                                            <td>Pieds</td>
                                            <td><input name="6accSiege" class="form-control text-center"  type="number" required></td>
                                        </tr>
                                        <tr>
                                            <td>Mains</td>
                                            <td><input name="7accSiege" class="form-control text-center"  type="number" required></td>
                                        </tr>
                                        <tr>
                                            <td>Doigts</td>
                                            <td><input name="8accSiege" class="form-control text-center"  type="number" required></td>
                                        </tr>
                                        <tr>
                                            <td>Thorax/ Lombaire</td>
                                            <td><input name="9accSiege" class="form-control text-center"  type="number" required></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    Répartition des accidents de travail selon l'ancienneté :
                                </h2>
                            </div>
                            <div class="body">
                                <table id="" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Ancienneté</th>
                                            <th>Nbr d'accidents</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1 sem à 1 mois</td>
                                            <td><input name="0accAnciennete" class="form-control text-center"  type="number" required></td>
                                        </tr>
                                        <tr>
                                            <td>1 mois à 3 mois</td>
                                            <td><input name="1accAnciennete" class="form-control text-center"  type="number" required></td>
                                        </tr>
                                        <tr>
                                            <td>3 mois à 6 mois</td>
                                            <td><input name="2accAnciennete" class="form-control text-center"  type="number" required></td>
                                        </tr>
                                        <tr>
                                            <td>6 mois à 1 an</td>
                                            <td><input name="3accAnciennete" class="form-control text-center"  type="number" required></td>
                                        </tr>
                                        <tr>
                                            <td>1 an à 5 ans</td>
                                            <td><input name="4accAnciennete" class="form-control text-center"  type="number" required></td>
                                        </tr>
                                        <tr>
                                            <td>5 ans et plus</td>
                                            <td><input name="5accAnciennete" class="form-control text-center"  type="number" required></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    Répartition des accidents de travail par fonction :
                                </h2>
                            </div>
                            <div class="body">
                                <table id="parFctTable" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Fonctions</th>
                                            <th>Nbr d'accidents</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="parFct">
                                        <tr>
                                            <td>
                                                <select id="fct" class="form-control show-tick">
                                                    <option value="">-- Selectionnez une fonction --</option>
                                                    @foreach ($fonctions as $fct)
                                                        <option value="{{$fct->intitule}}">{{$fct->intitule}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td><input id="nbr" class="form-control text-center" type="number"></td>
                                            <td>
                                                <button type="button" class="add-row btn bg-light-green btn-circle waves-effect waves-circle waves-float">
                                                    <i class="material-icons">add_circle</i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row clearfix demo-button-sizes">
                    <div class="col-md-offset-8 col-md-2">
                        <a href="{{url('/BilanAccidentT/details')}}" type="reset" class="btn btn-default btn-block btn-lg waves-effect">Annuler</a>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn bg-teal btn-block btn-lg waves-effect">Valider</button>
                    </div>
                </div>
            </form>
            <div class="row">
                <br/><br/><br/>
            </div>

        </div>
    </section>

    <!-- Default Size -->
    <div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                </div>
                <div class="modal-body">
                    <div class="row clearfix">
                        <div class="col-sm-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control">
                                    <label class="form-label">Fonction</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-4">
                                <label class="form-label">Nombre d'accidents</label>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group spinner" data-trigger="spinner">
                                <div class="form-line">
                                    
                                    <input type="text" class="form-control text-center col-sm-6" value="1" data-rule="quantity">
                                </div>
                                <span class="input-group-addon">
                                    <a href="javascript:;" class="spin-up" data-spin="up"><i class="glyphicon glyphicon-chevron-up"></i></a>
                                    <a href="javascript:;" class="spin-down" data-spin="down"><i class="glyphicon glyphicon-chevron-down"></i></a>
                                </span>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link waves-effect">Ajouter</button>
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
    function addRow(){
            var name = $("#name").val();
            var email = $("#email").val();
            var markup = "<tr><td><input type='checkbox' name='record'></td><td >" + name + "<input type='hidden' name='" + this.rowIndex+ "fct' value='" + name + "'></td><td>" + email + "<input type='hidden' name='" + this.rowIndex+ "nbr_accidents' value='" + email + "'></td></tr>";
            $("#parFct").append(markup);
            
        }
    </script>
    <!-- Jquery Spinner Plugin Js -->
    <script src="{{asset('assets/plugins/jquery-spinner/js/jquery.spinner.js')}}"></script>

    <!-- Moment Plugin Js -->
    <script src="{{asset('assets/plugins/momentjs/moment.js')}}"></script>

    
    <!-- Select Plugin Js -->
    <script src="{{asset('assets/plugins/bootstrap-select/js/bootstrap-select.js')}}"></script>

    <script src="{{asset('assets/js/pages/forms/advanced-form-elements.js')}}"></script>
    <script src="{{asset('assets/js/pages/forms/basic-form-elements.js')}}"></script>

@endsection