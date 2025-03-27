@extends('layouts.master')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Nouveau rapport de visite</h2>

        <form action="{{ url('/ajoutRapport') }}" method="POST">
            @csrf
            <div class="row">
                <!-- Section Praticien -->
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <h5>Informations du praticien</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="praticien_id">Praticien</label>
                                <select class="form-control mb-3" id="praticien_id" name="praticien_id" required>
                                    <option value="">Sélectionnez un praticien</option>
                                    @foreach($praticiens as $praticien)
                                        <option value="{{ $praticien->id_praticien }}">{{ $praticien->nom_praticien }} {{ $praticien->prenom_praticien }}</option>
                                    @endforeach
                                </select>

                                <label for="visiteur_id" class="mt-4">Visiteur</label>
                                <select class="form-control" id="visiteur_id" name="visiteur_id" required>
                                    @foreach($visiteurs as $visiteur)
                                        <option value="{{ $visiteur->id_visiteur }}">{{ $visiteur->nom_visiteur }} {{ $visiteur->prenom_visiteur }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section Rapport -->
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <h5>Détails de la visite</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="date_rapport">Date de la visite</label>
                                <input type="date" class="form-control" id="date_rapport" name="date_rapport" required>
                            </div>

                            <div class="form-group">
                                <label for="motif">Motif de la visite</label>
                                <input type="text" class="form-control" id="motif" name="motif" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section Bilan -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5>Bilan de la visite</h5>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="bilan">Bilan</label>
                        <textarea class="form-control" id="bilan" name="bilan" rows="5" required></textarea>
                    </div>
                </div>
            </div>



            <div class="text-center">
                <button type="submit" class="btn btn-success btn-lg">Enregistrer le rapport</button>
                <a class="btn btn-secondary btn-lg ml-3">Annuler</a>
            </div>
        </form>
    </div>
@endsection
