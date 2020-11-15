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
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-3">
                <div class="card profile-card">
                    <div class="profile-header">&nbsp;</div>
                    <div class="profile-body">
                        <div class="image-area">
                            <img src="{{asset('assets/images/userDefault.png')}}" height="150px" alt="Profile Image" />
                        </div>
                        <div class="content-area">
                            <h3>{{$employe->nom}}</h3>
                            <p>{{$employe->fonction}}</p>
                            <p>
                                @if ($employe->unite == 1)
                                <td>Unité Terga</td>
                                @else
                                    <td>Unité Hennaya</td>
                                @endif
                            </p>
                        </div>
                    </div>

                    {{-- <div class="profile-footer">
                        <ul>
                            <li>
                                <span>Followers</span>
                                <span>1.234</span>
                            </li>
                            <li>
                                <span>Friends</span>
                                <span>14.252</span>
                            </li>
                        </ul>
                    </div> --}}

                </div>
            </div>
            <div class="col-xs-12 col-sm-9">
                <div class="card">
                    <div class="body">
                        <div>
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Profile</a></li>
                                <li role="presentation"><a href="#profile_settings" aria-controls="settings" role="tab" data-toggle="tab">Medcine de travail</a></li>
                            </ul>

                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="home">
                                    <div class="row container">
                                        <div class="col-md-2">
                                            <b> Matricule </b>
                                        </div>
                                        <div class="content col-md-10">
                                            {{$employe->matricule}}
                                        </div>
                                        <div class="col-md-2">
                                            <b> Sexe</b>
                                        </div>
                                        <div class="content col-md-10">
                                            {{$employe->sexe}}
                                        </div>
                                        <div class="col-md-2">
                                            <b> Statut </b>
                                        </div>
                                        <div class="content col-md-10">
                                            {{$employe->statut}}
                                        </div>
                                        <div class="col-md-2">
                                            <b> Date de naissance </b>
                                        </div>
                                        <div class="content col-md-10">
                                            {{$employe->date_naissance}}
                                        </div>
                                        <div class="col-md-2">
                                            <b> Date de recrutement </b>
                                        </div>
                                        <div class="content col-md-10">
                                            {{$employe->date_rec}}
                                        </div>
                                        <div class="col-md-2">
                                            <b> Affectation </b>
                                        </div>
                                        <div class="content col-md-10">
                                            {{$employe->affectation}}
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade in" id="profile_settings">
                                    <div class="table-responsive">

                                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                           
                                            <thead>
                                                <tr>
                                                    <th>Affectation</th>
                                                    <th>Visite <br> périodique</th>
                                                    <th>Radiographie</th>
                                                    <th>Examen <br> biologique</th>
                                                    <th>Observations</th>
                                                </tr>
                                            </thead>
                                            
                                            <tbody>
                                                @foreach ($employe->canevas as $caneva)
                                                <tr>
                                                    <td class="text-center">{{$caneva->affectation}}</td>
                                                    <td class="text-center">{{$caneva->visite_periodique}}</td>
                                                    <td class="text-center">
                                                        @if (! $caneva->radiographie) - @endif
                                                        {{$caneva->radiographie}}
                                                    </td>
                                                    <td class="text-center">
                                                        @if (! $caneva->examen_bio) - @endif
                                                        {{$caneva->examen_bio}}
                                                    </td>
                                                    <td >
                                                        @if (! $caneva->observation) - @endif
                                                        {{$caneva->observation}}
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
            </div>
        </div>
    </div>
</section>
@endsection