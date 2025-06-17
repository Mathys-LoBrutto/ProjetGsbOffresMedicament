@extends('layouts.master')

@section('content')
    {!! Form::open(['url' => route('medicaments.update'), 'class' => 'form-horizontal']) !!}

    <div class="col-md-12 well well-md">
        <center><h1>Modification</h1></center>

        <div class="form-group">
            <label class="col-md-3 control-label">Nom médicament :</label>
            <div class="col-md-6 col-md-3">
                <select class="form-control mb-3" id="medicament_offert" name="medicament_offert" required>
                    @foreach($medicaments as $medicament)
                        <option value="{{ $medicament->nom_commercial }}" {{ $medicament->id_medicament == $monOffre->id_medicament ? 'selected' : '' }}>
                            {{ $medicament->nom_commercial }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-3 control-label">Quantité offerte :</label>
            <div class="col-md-6 col-md-3">
                <input type="text" name="qte_offerte" class="form-control" value="{{ $monOffre->qte_offerte }}" placeholder="Quantité offerte">
            </div>
        </div>

        <input type="hidden" name="id_rapport" value="{{ $monOffre->id_rapport }}">
        <input type="hidden" name="id_medicament_actuel" value="{{ $monOffre->id_medicament }}">

        <div class="form-group">
            <div class="col-md-6 col-md-offset-3">
                <button type="submit" class="btn btn-default btn-primary">
                    <span class="glyphicon glyphicon-log-in"></span> Valider
                </button>
            </div>
        </div>
    </div>

    {!! Form::close() !!}
@stop
