@extends('layouts.master')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Nouveau Médicament offert</h2>

        <form action="{{ route('medicaments.ajoutMedicamentOffert') }}" method="POST">
            @csrf


            <div class="card-body">
                <div class="form-group">
                    <label for="date_rapport">Médicament offert</label>
                    <select class="form-control mb-3" id="medicament_offert" name="medicament_offert" required>
                        @foreach($medicaments as $medicament)
                            <option value="{{ $medicament->id_medicament }}">{{ $medicament->nom_commercial }} </option>
                        @endforeach

                    </select>
{{--                    <input type="text" class="form-control" id="medicament_offert" name="medicament_offert" required>--}}
                </div>

                <div class="form-group">
                    <label for="motif">quantité offerte</label>
                    <input type="text" class="form-control" id="qte" name="qte" required>
                </div>

                <input type="hidden" name="id_rapport" value="{{ $rapport }}">
            </div>



            <div class="text-center">
                <button type="submit" class="btn btn-success btn-lg">Enregistrer le medicament</button>
                <a class="btn btn-secondary btn-lg ml-3">Annuler</a>
            </div>
        </form>
    </div>
@endsection
