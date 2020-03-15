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
            <div class="row" style="margin-bottom: 25px">
                <div class="col-md-6 col-lg-6">
                </div>
                <div class="col-md-3 col-lg-3">
                    <a type="button" href="{{url('/BilanAccidentT/create')}}" class="btn bg-teal btn-block btn-lg waves-effect">Nouveau bilan</a>
                </div>
                <div class="col-md-3 col-lg-3">
                    <button type="button" class="btn bg-teal btn-block btn-lg waves-effect" data-toggle="modal" data-target="#import">Exporter le bilan annuel</button>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Bilan des accidents de travail par mois :
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">

                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>Intitulé</th>
                                            <th>Année</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Bilan des accidents de travail 2019</td>
                                            <td >2019</td>
                                            <td >
                                                <div class="icon-button-demo">
                                                    <a href="{{url('/BilanAccidentT/BilanMois')}}" type="button" class="btn bg-cyan btn-circle waves-effect waves-circle waves-float">
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
                                Bilan des accidents de travail par trimestre :
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">

                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>Intitulé</th>
                                            <th>Trimestre</th>
                                            <th>Année</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Bilan des accidents de travail 2019</td>
                                            <td>T1</td>
                                            <td >2019</td>
                                            <td >
                                                <div class="icon-button-demo">
                                                    <a href="{{url('/BilanAccidentT/BilanTrimestre')}}" type="button" class="btn bg-cyan btn-circle waves-effect waves-circle waves-float">
                                                        <i class="material-icons">details</i>
                                                    </a>
                                                </div>
                                            </td>
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
                                Bilan des accidents de travail par semestre :
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">

                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>Intitulé</th>
                                            <th>Semestre</th>
                                            <th>Année</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Bilan des accidents de travail 2019</td>
                                            <td >S1</td>
                                            <td >2019</td>
                                            <td >
                                                <div class="icon-button-demo">
                                                    <a href="{{url('/BilanAccidentT/BilanSemestre')}}" type="button" class="btn bg-cyan btn-circle waves-effect waves-circle waves-float">
                                                        <i class="material-icons">details</i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        
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

