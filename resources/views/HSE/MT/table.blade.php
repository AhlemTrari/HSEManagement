<div style="visibility: hidden">
    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
        <thead>
            <tr>
                <th>Matricule</th>
                <th>Nom et prénom</th>
                <th>Fonction</th>
                <th>Statut</th>
                <th>Date de naissance</th>
                <th>Data de recrutement</th>
                <th>Age</th>
                <th>Sexe</th>
                <th>Affectation</th>
                <th>Visite d'embauche</th>
                <th>Poste à risque</th>
                <th>Visite périodique</th>
                <th>Radiographie</th>
                <th>Examen biologique</th>
                <th>Observation</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($canevasExport as $annuel)
            <tr>
                <td>{{$annuel->employe->matricule}}</td>
                <td>{{$annuel->employe->nom}}</td>
                <td>{{$annuel->employe->fonction}}</td>
                <td>{{$annuel->employe->statut}}</td>
                <td>{{$annuel->employe->date_naissance}}</td>
                <td>{{$annuel->employe->date_rec}}</td>
                <td>
                    @php
                        $age = \Carbon\Carbon::parse($annuel->employe->date_naissance)->diff(\Carbon\Carbon::now())->format('%y ans');
                    @endphp
                    {{$age}}
                </td>
                <td>{{$annuel->employe->sexe}}</td>
                <td>{{$annuel->affectation}}</td>
                <td>{{$annuel->employe->visite_embauche}}</td>
                <td>{{$annuel->employe->poste_risque}}</td>
                <td>
                    @if (!$annuel->visite_periodique)
                        -
                    @endif
                    {{$annuel->visite_periodique}}
                </td>
                <td>
                    @if (!$annuel->radiographie)
                        -
                    @endif
                    {{$annuel->radiographie}}
                </td>
                <td>
                    @if (!$annuel->examen_bio)
                        -
                    @endif
                    {{$annuel->examen_bio}}
                </td>
                <td>
                    @if (!$annuel->observation)
                        -
                    @endif
                    {{$annuel->observation}}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>