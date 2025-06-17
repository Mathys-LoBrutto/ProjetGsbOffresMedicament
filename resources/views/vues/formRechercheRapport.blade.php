@extends('layouts.master')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Recherche de rapports de visite</h2>

        <form action="{{ url('/afficherRapportVisite') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <input type="text" name="nom_praticien" class="form-control" placeholder="Nom du praticien">
                </div>
                <div class="col-md-4">
                    <input type="text" name="date_rapport" class="form-control" placeholder="AAAA ou AAAA-MM-JJ">
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">Rechercher</button>
                </div>
            </div>
        </form>

        @if(isset($rapports) && count($rapports) > 0)
            <h3 class="mt-4">Résultats</h3>
            <table class="table table-bordered mt-2">
                <thead>
                <tr>
                    <th>ID Rapport</th>
                    <th>Nom Praticien</th>
                    <th>Date Rapport</th>
                    <th>Bilan</th>
                    <th>Motif</th>
                    <th>Médicament offert</th>
                </tr>
                </thead>
                <tbody>
                @foreach($rapports as $rapport)
                    <tr>
                        <td>{{ $rapport->id_rapport }}</td>
                        <td>{{ $rapport->nom_praticien }}</td>
                        <td>{{ $rapport->date_rapport }}</td>
                        <td>{{ $rapport->bilan }}</td>
                        <td>{{ $rapport->motif }}</td>
                        <td>
                            <a href="{{ route('medicament.show', $rapport->id_rapport) }}"
                               class="btn btn-sm btn-info"
                               title="Voir les médicaments offerts">
                                <i class="fas fa-pills"></i> Voir
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @elseif(isset($rapports))
            <p class="mt-4 text-danger">Aucun rapport trouvé.</p>
        @endif
    </div>
@endsection

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
