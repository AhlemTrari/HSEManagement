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
                   <h2> BILAN MENSUEL CONSOLIDE DES ACCIDENTS DE TRAVAIL DU MOIS DE " {{$mois}} {{$annee}} " </h2>
                </td>
            </tr>
        </table><br>
        <h3 style="text-align: center">
            EPE / SPA - DIVINDUS APMC - Consolidé
        </h3>
        <table>
            <tr>
                <td style="padding: 5px">
                    <p>Nombre des accidents de travail : {{$accidents_total}}</p>
                </td>
                <td style="padding: 5px">
                    <p>Nombre des journées perdues : {{$jours_total}}</p>
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
                    @foreach ($consolideParJours as $accidentsParJour)
                        <th> {{$accidentsParJour->jour}}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Nbr d'accident sans arrêt</strong></td>
                @foreach ($consolideParJours as $accidentsParJour)
                    <td>{{$accidentsParJour->accidentsSans}}</td>
                @endforeach
                </tr>
                <tr>
                    <td><strong>Nbr d'accident avec arrêt</strong></td>
                @foreach ($consolideParJours as $accidentsParJour)
                    <td>{{$accidentsParJour->accidentsAvec}}</td>
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
                @foreach ($consolideParHeur as $parHeure)
                <tr>
                    <td><strong> {{$parHeure->heure}}</strong></td>
                    <td>{{$parHeure->accidents}}</td>
                    <td>
                        @php
                            $pourcentage = $parHeure->accidents * 100 / $consolideParHeur->sum('accidents')
                        @endphp
                        {{$pourcentage}} %
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>    
                    <th><strong>Total</strong></th>
                    <th>{{$consolideParHeur->sum('accidents')}}</th>
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
                @foreach ($consolideParSiege as $parSiege)
                <tr>
                    <td><strong> {{$parSiege->siege_lesions}}</strong></td>
                    <td>{{$parSiege->accidents}}</td>
                    <td>
                        @php
                            $pourcentage = $parSiege->accidents * 100 / $consolideParSiege->sum('accidents')
                        @endphp
                        {{$pourcentage}} %
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>    
                    <th><strong>Total</strong></th>
                    <th>{{$consolideParSiege->sum('accidents')}}</th>
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
                @foreach ($consolideParAnc as $parAnc)
                <tr>
                    <td><strong> {{$parAnc->anciennete}}</strong></td>
                    <td>{{$parAnc->accidents}}</td>
                    <td>
                        @php
                            $pourcentage = $parAnc->accidents * 100 / $consolideParAnc->sum('accidents')
                        @endphp
                        {{$pourcentage}} %
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>    
                    <th><strong>Total</strong></th>
                    <th>{{$consolideParAnc->sum('accidents')}}</th>
                    <th>100 %</th>
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
                @foreach ($consolideParFct as $parFct)
                <tr>
                    <td><strong> {{$parFct->fonction}}</strong></td>
                    <td>{{$parFct->accidents}}</td>
                    <td>
                        @php
                            $pourcentage = $parFct->accidents * 100 / $consolideParFct->sum('accidents')
                        @endphp
                        {{$pourcentage}} %
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>    
                    <th><strong>Total</strong></th>
                    <th>{{$consolideParFct->sum('accidents')}}</th>
                    <th>100 %</th>
                </tr>
            </tfoot>
        </table>
    </body>
</html>