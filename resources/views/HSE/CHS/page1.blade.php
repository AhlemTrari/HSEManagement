<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>APMC | Commission d'unité Hygiène et Sécurité</title>
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
                <td style="width: 20%">
                    <img src="{{ public_path('assets/images/logo.jpg') }}" alt="" height="100px">
                </td>
                <td style="width: 80%">
                   <h2> Commission d'unité Hygiène et Sécurité " {{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $commission->date)->format('m-Y')}} " </h2>
                </td>
            </tr>
        </table><br>
        <h3 style="text-align: center">
            EPE / SPA - DIVINDUS APMC - Unité 
            @if ($commission->unite == 1)
                Terga
            @elseif($commission->unite == 2)
                Hennaya
            @endif
        </h3>
        <h4>
           {{$commission->intitule}} 
        </h4>
         <table>
            <thead>
                <tr>
                    <th>Libellé</th>
                    <th>Nombre</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Nombre de réunions CHS</td>
                    <td> {{$commission->reunions_chs}}</td>
                </tr>
                <tr>
                    <td>Nombre de réunions CHS extraordinaires</td>
                    <td> {{$commission->reunions_extra}}</td>
                </tr>
                <tr>
                    <td>Nombre d'enquêtes menées par la CHS</td>
                    <td> {{$commission->nbr_enquete}}</td>
                </tr>
                <tr>
                    <td>Nombre de cas de recours à un expert</td>
                    <td> {{$commission->cas_recours}}</td>
                </tr>
            </tbody>
        </table>
    </body>
</html>