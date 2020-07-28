<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>APMC | Déclaration accident matériel</title>
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
                <td class="centerText" style="width: 20%" rowspan="2">
                    <img src="{{ public_path('assets/images/logo.jpg') }}" alt="" height="100px">
                </td>    
                <td class="centerText" style="width: 50%" rowspan="2">
                    <h2> Déclaration d’Accident de Matériel  </h2>
                </td>
                <td class="centerText" style="border-bottom: 1px solid #000;">D.A.M n° {{$declaration->num}}</td>
            </tr>
            <tr>
                <td class="centerText">Date: {{$declaration->date}}</td>
            </tr>
        </table><br>
        <table>
            <tr>
                <th  style="padding: 0px; border-bottom: 1px solid #000;" class="centerText" colspan="2">
                    <h3 style="font-family: Arial, Helvetica, sans-serif; "> Identité du Responsable d’Accident  </h3>
                </th>
            </tr>
            <tr>
                <td style="width: 31%">Nom : </td>
                <td>{{$declaration->responsable->nom}} </td>
            </tr>
            <tr>
                <td style="width: 31%">Prénom : </td>
                <td>{{$declaration->responsable->prenom}} </td>
            </tr>
            <tr>
                <td style="width: 31%">Date de naissance : </td>
                <td>{{$declaration->responsable->date_naissance}} </td>
            </tr>
            <tr>
                <td style="width: 31%">Date de recrutement : </td>
                <td>{{$declaration->responsable->date_recrutement}} </td>
            </tr>
            <tr>
                <td style="width: 31%">Qualification professionnelle : </td>
                <td>{{$declaration->responsable->fonction}} </td>
            </tr>
        </table>
        
        <table>
            <tr>
                <th  style="padding: 0px; border-bottom: 1px solid #000;" class="centerText" colspan="3">
                    <h3 style="font-family: Arial, Helvetica, sans-serif;"> Accident  </h3>
                </th>
            </tr>
            <tr >
                <td style="width: 30%; border-bottom: 1px solid #000;" colspan="2" >L’accident à t-il fait d’autres victimes ? : </td>
                <td style=" border-bottom: 1px solid #000;">
                    @if ($declaration->autre_victimes)
                       Oui
                    @else 
                       Non 
                    @endif 
                </td>
            </tr>
            <tr>
                <td style="width: 30%">Site : </td>
                <td colspan="2">{{$declaration->chantier}} </td>
            </tr>
            <tr>
                <td style="width: 30%">Lieu exact de l’accident :</td>
                <td colspan="2">{{$declaration->lieu}} </td>
            </tr>
            <tr>
                <td style="width: 30%">Date :  </td>
                <td colspan="2">{{$declaration->date}} </td>
            </tr>
            <tr>
                <td style="width: 30%; border-bottom: 1px solid #000;">Heure : </td>
                <td colspan="2" style="border-bottom: 1px solid #000;">{{$declaration->heure}} </td>
            </tr>
            <tr>
                <td colspan="3" style="text-align: center;border-bottom: 1px solid #000;">
                    Que faisait le Responsable de l’accident au moment de l’accident ?
                </td>
            </tr>
            <tr>
                <td colspan="3" style="text-align: center; border-bottom: 1px solid #000;">
                    {{$declaration->travail_courrant}}
                </td>
            </tr>
            <tr >
                <td style="width: 30%;" colspan="2" >Eléments matériels à l’origine de l’accident : </td>
                <td style=" border-bottom: 1px solid #000;">
                   {{$declaration->materiel}}
                </td>
            </tr>
        </table>

        <table>
            <tr>
                <th  style="padding: 0px; border-bottom: 1px solid #000;" class="centerText" colspan="3">
                    <h3 style="font-family: Arial, Helvetica, sans-serif;"> Causes de l’accident </h3>
                </th>
            </tr>

            <tr>
                <td style="width: 50%; border-bottom: 1px solid #000; text-align:center; font-size:18px" colspan="2"><strong> Directes <strong></strong></td>
                <td style="width: 50%; border-bottom: 1px solid #000; text-align:center; font-size:18px"><strong> Indirectes </strong></td>
            </tr>
            <tr>
                <td colspan="2" style=" border-bottom: 1px solid #000;"> {{$declaration->cause_direct}}  </td>
                <td style=" border-bottom: 1px solid #000;"> {{$declaration->cause_indirect}} </td>
            </tr>
            <tr>
                <td style="width: 30%; border-bottom: 1px solid #000;">Conséquences :  </td>
                <td colspan="2" style="border-bottom: 1px solid #000;">{{$declaration->consequences}} </td>
            </tr>
            <tr>
                <td colspan="2" style="width: 30%; border-bottom: 1px solid #000;">L’accident a-t-il été causé par un tiers ?</td>
                <td style="border-bottom: 1px solid #000;">
                    @if ($declaration->tiers)
                        Oui
                    @else
                        Non
                    @endif
                </td>
            </tr>
            @if ($declaration->tiers)
            <tr>
                <td colspan="3" style="text-align: center;border-bottom: 1px solid #000;">
                    coordonnées du tiers
                </td>
            </tr>
            <tr>
                <td>Nom :</td>
                <td colspan="2">
                    {{$declaration->tiers_nom}}
                </td>
            </tr>
            <tr>
                <td>Prénom :</td>
                <td colspan="2">
                    {{$declaration->tiers_prenom}}
                </td>
            </tr>
            <tr>
                <td>Adress :</td>
                <td colspan="2">
                    {{$declaration->tiers_adress}}
                </td>
            </tr>
            @endif
        </table>

        <table>
            <tr>
                <th  style="padding: 0px; border-bottom: 1px solid #000;" class="centerText" colspan="3">
                    <h3 style="font-family: Arial, Helvetica, sans-serif;"> Témoins  </h3>
                </th>
            </tr>
            <tr>
                <td style="width: 30%; border-bottom: 1px solid #000;">Nom et prénom des témoins: </td>
                <td colspan="2" style="border-bottom: 1px solid #000;">{{$declaration->temoins}} </td>
            </tr>
            <tr>
                <td colspan="2" style="border-bottom: 1px solid #000;">Existe-t-il une constatation de police ?</td>
                <td style="width: 50%; border-bottom: 1px solid #000;">
                    @if ($declaration->constatation_police)
                        Oui
                    @else
                        Non
                    @endif
                </td>
            </tr>
            
            @if ($declaration->constatation_police)
            <tr>
                <td style="width: 30%">laquelle / où :  </td>
                <td colspan="2">{{$declaration->constatation_police}} </td>
            </tr>
            @endif
        </table>

        <table>
            <tr>
                <th  style="padding: 0px; border-bottom: 1px solid #000;" class="centerText">
                    <h3 style="font-family: Arial, Helvetica, sans-serif;"> Circonstances détaillées de l’accident  </h3>
                </th>
            </tr>
            <tr>
                <td>
                    {{$declaration->circonstances_detaillees}}
                </td>
            </tr>
        </table>
    </body>
</html>