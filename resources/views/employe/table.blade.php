    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
        <thead>
            <tr>
                <th>Matricule</th>
                <th>Nom et prénom</th>
                <th>Fonction</th>
                @if (Auth::user()->is_admin)
                <th>unité</th>
                @endif
                <th>Statut</th>
                <th>Date de naissance</th>
                <th>Data de recrutement</th>
                <th>Age</th>
                <th>Sexe</th>
                <th>Affectation</th>
                <th>Visite d'embauche</th>
                <th>Poste à risque</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employes as $employe)
            <tr>
                <td>{{$employe->matricule}}</td>
                <td>{{$employe->nom}}</td>
                <td>{{$employe->fonction}}</td>
                @if (Auth::user()->is_admin)
                    @if ($employe->unite == 1)
                        <td>Unité Terga</td>
                    @else
                        <td>Unité Hennaya</td>
                    @endif
                @endif
                <td>{{$employe->statut}}</td>
                <td>{{$employe->date_naissance}}</td>
                <td>{{$employe->date_rec}}</td>
                <td>
                    @php
                        $age = \Carbon\Carbon::parse($employe->date_naissance)->diff(\Carbon\Carbon::now())->format('%y ans');
                    @endphp
                    {{$age}}
                </td>
                <td>{{$employe->sexe}}</td>
                <td>{{$employe->affectation}}</td>
                <td>{{$employe->visite_embauche}}</td>
                <td>{{$employe->poste_risque}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>