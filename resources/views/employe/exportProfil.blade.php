<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>APMC | Profil</title>
        <style>
            table{  
            border: 1px solid #000;
            text-align: left;
            }

            table {
            border-collapse: collapse;
            width: 100%;
            }
            th {
            background-color: red;
            color: white;
            }
            td {
            padding: 9px;
            }
            tr,td {
            border-bottom: 0px;
            border-left: 1px solid #000;
            }
            .centerText{
            text-align: center;
            }
            h4 {
                padding-left: 30px;
            }
        </style>
    </head>
    <body>
        <table>
            <tr>
                <td class="centerText" style="width: 25%">
                    <img src="{{ public_path('assets/images/logo.jpg') }}" alt="" height="100px" width="80px">
                </td>    
                <td class="centerText" style="width: 50%" rowspan="2">
                    <h2> FICHE SIGNALITIQUE </h2>
                </td>   
                <td class="centerText" style="width: 25%; padding: 0px" rowspan="2">
                    <img src="{{ public_path($employe->photo) }}" style="padding: 0px" height="150px" width="100px" >
                </td>
            </tr>
            <tr style="padding: 0px;">
                <td style="padding: 0px; border-top: 1px solid #000;" class="centerText">Unité : {{$employe->unite}} </td>
            </tr>
        </table><br>
        <div class="row">
            <div class="col-md-4">
                <table></table>
            </div>
            <div class="col-md-8">
                <table>
                    <tr>
                        <th  style="padding: 0px; border-bottom: 1px solid #000;" class="centerText" colspan="2">
                            <h3 style="font-family: Arial, Helvetica, sans-serif; "> Informations  </h3>
                        </th>
                    </tr>
                    <tr>
                        <td style="width: 35%">Matricule : </td>
                        <td>{{$employe->matricule}} </td>
                    </tr>
                    <tr>
                        <td style="width: 35%">Nom & prénom: </td>
                        <td>{{$employe->nom}} </td>
                    </tr>
                    <tr>
                        <td style="width: 35%">Date de naissance : </td>
                        <td>{{$employe->date_naissance}} </td>
                    </tr>
                    <tr>
                        <td style="width: 35%">Lieu de naissance : </td>
                        <td>{{$employe->lieu_naissance}} </td>
                    </tr>
                    <tr>
                        <td style="width: 35%">Sexe : </td>
                        <td>{{$employe->sexe}} </td>
                    </tr>
                    <tr>
                        <td style="width: 35%">Adresse : </td>
                        <td>{{$employe->adresse}} </td>
                    </tr>
                    <tr>
                        <td style="width: 35%; border-bottom: 1px solid #000;">Situation familiale : </td>
                        <td style=" border-bottom: 1px solid #000;">{{$employe->situation}} </td>
                    </tr>
                    <tr>
                        <td style="width: 35%">Date de recrutement : </td>
                        <td>{{$employe->date_rec}} </td>
                    </tr>
                    <tr>
                        <td style="width: 35%">Qualification professionnelle : </td>
                        <td>{{$employe->fonction}} </td>
                    </tr>
                    <tr>
                        <td style="width: 35%">Affectation : </td>
                        <td>{{$employe->affectation}} </td>
                    </tr>
                    <tr>
                        <td style="width: 35%">N° Sécurité sociale : </td>
                        <td>{{$employe->num_sociale}} </td>
                    </tr>
                    <tr>
                        <td style="width: 35%">Statut : </td>
                        <td>{{$employe->statut}} </td>
                    </tr>
                    <tr>
                        <td style="width: 35%">Poste à risque : </td>
                        <td>{{$employe->poste_risque}} </td>
                    </tr>
                    <tr>
                        <td style="width: 35%">Visite d'embauche : </td>
                        <td>{{$employe->visite_embauche}} </td>
                    </tr>
                </table>
            </div>
        </div>
        @if (! $employe->canevas->isEmpty())
        <table>
            <tr>
                <th  style="padding: 0px; border-bottom: 1px solid #000;" class="centerText" colspan="5">
                    <h3 style="font-family: Arial, Helvetica, sans-serif;"> Médcine de travail </h3>
                </th>
            </tr>
            <tr>
                <td class="centerText"><b> Affectation </b></td>
                <td class="centerText"><b> Visite périodique </b></td>
                <td class="centerText"><b> Radiographie </b></td>
                <td class="centerText"><b> Examen biologique </b></td>
                <td class="centerText"><b> Observations </b></td>
            </tr>
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
        </table>
        @endif
        @if (! $employe->amenagements->isEmpty())
        <table>
            <tr>
                <th  style="padding: 0px; border-bottom: 1px solid #000;" class="centerText" colspan="5">
                    <h3 style="font-family: Arial, Helvetica, sans-serif;"> Aménagements du poste </h3>
                </th>
            </tr>
            <tr>
                <td class="centerText"><b> Ancien poste </b></td>
                <td class="centerText"><b> Nouveau poste </b></td>
                <td class="centerText"><b> Date de visite après changement </b></td>
            </tr>
            @foreach ($employe->amenagements as $amenagement)
            <tr>
                <td class="text-center">{{$amenagement->old_post}}</td>
                <td class="text-center">{{$amenagement->new_post}}</td>
                <td class="text-center">
                    @if (! $amenagement->visite) - @endif
                    {{$amenagement->date}}
                </td>
            </tr>
            @endforeach
        </table>
        @endif
    </body>
</html>