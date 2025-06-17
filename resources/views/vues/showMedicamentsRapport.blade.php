@extends('layouts.master')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">médicaments du rapport ayant pour identifiant : {{$rapport}} </h2>

        <h3 class="mt-4">
            Résultats<br>
            pour ajouter un médicament offert cliquer :
            <a href="{{route('medicaments.formAjoutMedicamentOffert', [ 'id' => $rapport])}}">
        <span class="glyphicon glyphicon-plus"
              data-toggle="tooltip" data-placement="top" title="Ajouter">
        </span>
            </a>
        </h3>

        @if(isset($MesMedicaments) && count($MesMedicaments) > 0)

            <table class="table table-bordered mt-2">
                <thead>
                <tr>
                    <th>ID medicament</th>
                    <th>Nom medicament</th>
                    <th>Quantité offerte </th>
                    <th>Modifier un médicament</th>
                    <th>Supprimer un médicament</th>
                </tr>
                </thead>
                <tbody>
                @foreach($MesMedicaments as $monMedicament)
                    <tr>
                        <td>{{ $monMedicament->id_medicament ?? 'id manquant' }}</td>
                        <td>{{ $monMedicament->nom_commercial ?? 'nom manquant' }}</td>
                        <td>{{ $monMedicament->qte_offerte }}</td>

                        <td style="text-align:center;">
                            <a href="{{ route('medicaments.edit', ['id' => $monMedicament->id_medicament, 'rapport' => $rapport]) }}">

                            <span class="glyphicon glyphicon-pencil"
                                  data-toggle="tooltip" data-placement="top" title="Modifier">

                            </span></a></td>

                        <td style="text-align:center;">
                            <a  onclick="javascript:if (confirm('Suppression confirmée ?')) {
                    window.location='{{'/medicaments'}}/{{$monMedicament->id_medicament}}/{{$rapport}}'}">
                        <span class="glyphicon glyphicon-remove"
                              data-toggle="tooltip" data-placement="top" title="Supprimer">

                        </span></a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @elseif(isset($rapports))
            <p class="mt-4 text-danger">Aucun rapport trouvé.</p>
        @endif
    </div>
@endsection
