<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>APMC | Bilan Mensuel</title>
        <style>
            .header {
                border:2px solid red;
                padding: 0px;
            }

            .header .image {
                width: 15%;
                margin-top: 10px;
                margin-left: 50px;
            }

            .header .text {
                font:  sans-serif;
                font-size: 28px;
                text-align: center;
                margin-top: 40px;
                width: 80%;
            }

            .header .image, 
            .header .text {
                display: inline-block;
                vertical-align: bottom;
                margin-bottom: 0px;
            }
            table, td, th {  
            border: 1px solid #ddd;
            text-align: left;
            text-align: center;
            }

            table {
            border-collapse: collapse;
            width: 100%;
            }

            th, td {
            padding: 10px;
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
                <td style="width: 20%">
                    <img src="{{ public_path('assets/images/logo.jpg') }}" alt="" height="100px">
                </td>
                <td style="width: 80%">
                   <h2> BILAN MENSUEL DES ACCIDENTS DE TRAVAIL DU MOIS DE " {{$bilan->mois}} {{$bilan->annee}} " </h2>
                </td>
            </tr>
        </table><br>
        <h3 style="text-align: center">
            EPE / SPA - DIVINDUS APMC - Unité 
            @if ($bilan->unite == 1)
                Terga
            @elseif($bilan->unite == 2)
                Hennaya
            @endif
        </h3>
        <table>
            <tr>
                <td style="padding: 5px">
                    <p>Nombre des accidents de travail : {{$bilan->nbr_accidents}}</p>
                </td>
                <td style="padding: 5px">
                    <p>Nombre des journées perdues : {{$bilan->nbr_jours}}</p>
                </td>
            </tr>
        </table>
        <h4>
            - Répartition des accidents de travail selon les jours de la semaine :
        </h4>
        <table>
            <thead>
                <tr>
                    <th><strong>Jours</strong></th>
                    @foreach ($bilan->accidentsParJour as $accidentsParJour)
                        <th> {{$accidentsParJour->jour}}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Nbr d'accident sans arrêt</strong></td>
                @foreach ($bilan->accidentsParJour as $accidentsParJour)
                    <td>{{$accidentsParJour->avec_arret}}</td>
                @endforeach
                </tr>
                <tr>
                    <td><strong>Nbr d'accident avec arrêt</strong></td>
                @foreach ($bilan->accidentsParJour as $accidentsParJour)
                    <td>{{$accidentsParJour->sans_arret}}</td>
                @endforeach
                </tr>
            </tbody>
            <tfoot>
                <tr>    
                    <th><strong>Total</strong></th>
                    @foreach ($totalParJour as $total)
                        <th>{{$total}}</th>
                    @endforeach
                </tr>
            </tfoot>
        </table>
        <h4>
            - Répartition des accidents de travail par tranche d'horaires :
        </h4>
        <table>
            <thead>
                <tr>
                    <th>Tranches d'horaires</th>
                    <th>Nbr d'accidents</th>
                    <th>Pourcentage</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bilan->accidentParHeure as $accidentParHeure)
                <tr>
                    <td><strong> {{$accidentParHeure->heure}}</strong></td>
                    <td>{{$accidentParHeure->nbr_accidents}}</td>
                    <td>
                        @php
                            $pourcentage = $accidentParHeure->nbr_accidents * 100 / $bilan->accidentParHeure->sum('nbr_accidents')
                        @endphp
                        {{$pourcentage}} %
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>    
                    <th><strong>Total</strong></th>
                    <th>{{$bilan->accidentParHeure->sum('nbr_accidents')}}</th>
                    <th>100 %</th>
                </tr>
            </tfoot>
        </table>
        <h4 style="padding-top: 10px">
            - Répartition des accidents de travail par siège des lésions :
        </h4>
        <table>
            <thead>
                <tr>
                    <th>Siège des lésions</th>
                    <th>Nbr d'accidents</th>
                    <th>Pourcentage</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bilan->accidentParSiege as $accidentParSiege)
                <tr>
                    <td><strong> {{$accidentParSiege->siege_lesions}}</strong></td>
                    <td>{{$accidentParSiege->nbr_accidents}}</td>
                    <td>
                        @php
                            $pourcentage = $accidentParSiege->nbr_accidents * 100 / $bilan->accidentParSiege->sum('nbr_accidents')
                        @endphp
                        {{$pourcentage}} %
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>    
                    <th><strong>Total</strong></th>
                    <th>{{$bilan->accidentParSiege->sum('nbr_accidents')}}</th>
                    <th>100 %</th>
                </tr>
            </tfoot>
        </table>
        <h4>
            - Répartition des accidents de travail selon l'ancienneté :
        </h4>
        <table>
            <thead>
                <tr>
                    <th>Ancienneté</th>
                    <th>Nbr d'accidents</th>
                    <th>Pourcentage</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bilan->accidentParAnciennete as $accidentParAnciennete)
                <tr>
                    <td><strong> {{$accidentParAnciennete->anciennete}}</strong></td>
                    <td>{{$accidentParAnciennete->nbr_accidents}}</td>
                    <td>
                        @php
                            $pourcentage = $accidentParAnciennete->nbr_accidents * 100 / $bilan->accidentParAnciennete->sum('nbr_accidents')
                        @endphp
                        {{$pourcentage}} %
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>    
                    <th ><strong>Total</strong></th>
                    <th >{{$bilan->accidentParAnciennete->sum('nbr_accidents')}}</th>
                    <th >100 %</th>
                </tr>
            </tfoot>
        </table><br>
        <h4>
            - Répartition des accidents de travail par fonction :
        </h4>
        <table>
            <thead>
                <tr>
                    <th>Fonctions</th>
                    <th>Nbr d'accidents</th>
                    <th>Pourcentage</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bilan->accidentParFct as $accidentParFct)
                <tr>
                    <td><strong> {{$accidentParFct->fonction}}</strong></td>
                    <td>{{$accidentParFct->nbr_accidents}}</td>
                    <td>
                        @php
                            $pourcentage = $accidentParFct->nbr_accidents * 100 / $bilan->accidentParFct->sum('nbr_accidents')
                        @endphp
                        {{$pourcentage}} %
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>    
                    <th><strong>Total</strong></th>
                    <th>{{$bilan->accidentParFct->sum('nbr_accidents')}}</th>
                    <th>100 %</th>
                </tr>
            </tfoot>
        </table>
    </body>
</html>