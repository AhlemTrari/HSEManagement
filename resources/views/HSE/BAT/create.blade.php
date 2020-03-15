
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('table thead th').each(function(i) {
                calculateColumn(i);
            });
        });

        function calculateColumn(index) {
            var total = 0;
            $('table tr').each(function() {
                var value = parseInt($('td', this).eq(index).text());
                if (!isNaN(value)) {
                    total += value;
                }
            });
            $('table tfoot td').eq(index).text(total);
        }
    </script> -->
@extends('layouts.dash')

@section('titre')
<title>Bilan des accidents de travail | APMC Divindus</title>
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
                <li  class="active">
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
            <div class="block-header">
                <h2>
                    NOUVEAU BILAN DES ACCIDENTS DE TRAVAIL
                </h2>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Répartition des accidents de travail par moi :
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Vider le tableau</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <table id="" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Jan</th>
                                        <th>Fév</th>
                                        <th>Mars</th>
                                        <th>Avril</th>
                                        <th>Mai</th>
                                        <th>Juin</th>
                                        <th>Juil</th>
                                        <th>Aout</th>
                                        <th>Sept</th>
                                        <th>Oct</th>
                                        <th>Nov</th>
                                        <th>Déc</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Nbr accident de travail</td>
                                        <td contenteditable>0</td>
                                        <td contenteditable>0</td>
                                        <td contenteditable>0</td>
                                        <td contenteditable>0</td>
                                        <td contenteditable>0</td>
                                        <td contenteditable>0</td>
                                        <td contenteditable>0</td>
                                        <td contenteditable>0</td>
                                        <td contenteditable>0</td>
                                        <td contenteditable>0</td>
                                        <td contenteditable>0</td>
                                        <td contenteditable>0</td>
                                        <td ></td>
                                    </tr>
                                    <tr>
                                        <td>Nbr journées perdues</td>
                                        <td contenteditable>0</td>
                                        <td contenteditable>0</td>
                                        <td contenteditable>0</td>
                                        <td contenteditable>0</td>
                                        <td contenteditable>0</td>
                                        <td contenteditable>0</td>
                                        <td contenteditable>0</td>
                                        <td contenteditable>0</td>
                                        <td contenteditable>0</td>
                                        <td contenteditable>0</td>
                                        <td contenteditable>0</td>
                                        <td contenteditable>0</td>
                                        <td ></td>
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
                                Répartition des accidents de travail selon les jours de la semaine :
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Vider le tableau</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <table id="" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Jours</th>
                                        <th>Dim</th>
                                        <th>Lun</th>
                                        <th>Mar</th>
                                        <th>Merc</th>
                                        <th>Jeu</th>
                                        <th>Vend</th>
                                        <th>Sam</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Nbr d'accident sans arrêt</td>
                                        <td class="rowDataSd"  onkeyup="calculTotal()" value="12">12</td>
                                        <td class="rowDataSd" contenteditable>0</td>
                                        <td class="rowDataSd" contenteditable>0</td>
                                        <td class="rowDataSd" contenteditable>0</td>
                                        <td class="rowDataSd" contenteditable>0</td>
                                        <td class="rowDataSd" contenteditable>0</td>
                                        <td class="rowDataSd" contenteditable>0</td>
                                    </tr>
                                    <tr>
                                        <td>Nbr journées perdues</td>
                                        <td class="rowDataSd" contenteditable>0</td>
                                        <td class="rowDataSd" contenteditable>0</td>
                                        <td class="rowDataSd" contenteditable>0</td>
                                        <td class="rowDataSd" contenteditable>0</td>
                                        <td class="rowDataSd" contenteditable>0</td>
                                        <td class="rowDataSd" contenteditable>0</td>
                                        <td class="rowDataSd" contenteditable>0</td>
                                    </tr>
                                    <tr class="totalColumn">
                                        <td>Total</td>
                                        <td class="totalCol"></td>
                                        <td class="totalCol"></td>
                                        <td class="totalCol"></td>
                                        <td class="totalCol"></td>
                                        <td class="totalCol"></td>
                                        <td class="totalCol"></td>
                                        <td class="totalCol"></td>
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
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Vider le tableau</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <table id="sum_table" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Tranches d'horaires</th>
                                        <th>Nbr d'accidents</th>
                                        <th>Pourcentage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>6h à 8h</td>
                                        <td contenteditable>0</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>8h à 10h</td>
                                        <td contenteditable>0</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>10h à 12h</td>
                                        <td contenteditable>0</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>12h à 13h</td>
                                        <td contenteditable>0</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>13h à 15h</td>
                                        <td contenteditable>0</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>15h à 17h</td>
                                        <td contenteditable>0</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Autre</td>
                                        <td contenteditable>0</td>
                                        <td></td>
                                    </tr>
                                    
                                </tbody>
                                <tfoot>
                                    
                                    <tr>
                                        <td>Total</td>
                                        <td ></td>
                                        <td ></td>
                                    </tr>
                                </tfoot>
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
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Vider le tableau</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <table id="sum_table" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Siège des lésions</th>
                                        <th>Nbr d'accidents</th>
                                        <th>Pourcentage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Yeux</td>
                                        <td contenteditable>0</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Figure</td>
                                        <td contenteditable>0</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Tête</td>
                                        <td contenteditable>0</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Bassin</td>
                                        <td contenteditable>0</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Membres inférieurs</td>
                                        <td contenteditable>0</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Membres supérieurs</td>
                                        <td contenteditable>0</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Pieds</td>
                                        <td contenteditable>0</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Mains</td>
                                        <td contenteditable>0</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Doigts</td>
                                        <td contenteditable>0</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Thorax/ Lombaire</td>
                                        <td contenteditable>0</td>
                                        <td></td>
                                    </tr>
                                    <tfoot>  
                                        <tr>
                                            <td >Total</td>
                                            <td ></td>
                                            <td ></td>
                                        </tr>
                                    
                                    </tfoot>
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
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Vider le tableau</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <table id="" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Ancienneté</th>
                                        <th>Nbr d'accidents</th>
                                        <th>Pourcentage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1 sem à 1 mois</td>
                                        <td contenteditable>0</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>1 mois à 3 mois</td>
                                        <td contenteditable>0</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>3 mois à 6 mois</td>
                                        <td contenteditable>0</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>6 mois à 1 an</td>
                                        <td contenteditable>0</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>1 an à 5 ans</td>
                                        <td contenteditable>0</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>5 ans et plus</td>
                                        <td contenteditable>0</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Total</td>
                                        <td ></td>
                                        <td ></td>
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
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Vider le tableau</a></li>
                                        <li><a href="#" type="button" data-toggle="modal" data-color="light-green" data-target="#defaultModal" >Ajouter une ligne</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <table id="" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Fonctions</th>
                                        <th>Nbr d'accidents</th>
                                        <th>Pourcentage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td>Total</td>
                                        <td ></td>
                                        <td ></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row clearfix demo-button-sizes">
                <div class="col-md-offset-8 col-md-2">
                    <button href="index.html" type="button" class="btn btn-default btn-block btn-lg waves-effect">Annuler</button>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn bg-teal btn-block btn-lg waves-effect">Valider</button>
                </div>
            </div>
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

    <!-- <script>
        $('#sum_table tr:first td').each(function(){
            var $td = $(this);  
            
            var colTotal = 0;
            $('#sum_table tr:not(:first,.totalColumn)').each(function(){
                colTotal  += parseInt($(this).children().eq($td.index()).html(),10);
            });
            
            $('#sum_table tr.totalColumn').children().eq($td.index()).html(colTotal);
        });
        
    </script> -->
@endsection
