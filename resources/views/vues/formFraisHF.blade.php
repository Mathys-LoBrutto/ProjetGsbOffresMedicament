@extends("layouts.master")
@section('content')
    {!! Form::open(['url' => 'validerFraisHF/'.$unFraisHF->id_fraishorsforfait]) !!}
    <div class="col-md-12  col-sm-12 well well-md">
        <h1>{{$titreVue}} </h1>
        <div class="form-horizontal">
            <input type="hidden" name="id_fraishorsforfait" value="{{$unFraisHF->id_fraishorsforfait}}"/>
            <div class="form-group">
                <label class="col-md-3 col-sm-3 control-label">Date : </label>
                <div class="col-md-2 col-sm-2">
                    <input type="text" name="date_fraishorsforfait" value="{{$unFraisHF->date_fraishorsforfait}}" class="form-control" placeholder="AAAA-MM" required autofocus >
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 col-sm-3 control-label">Libellé : </label>
                <div class="col-md-2 col-sm-2">
                    <input type="text" name="lib_fraishorsforfait" value="{{$unFraisHF->lib_fraishorsforfait}}" class="form-control" placeholder="" required autofocus maxlength="7">
                </div>
            </div>


            <div class="form-group">
                <label class="col-md-3 col-sm-3 control-label">montant : </label>
                <div class="col-md-2  col-sm-2">
                    <input type="number" name="montant_fraishorsforfait" value="{{$unFraisHF->montant_fraishorsforfait}}"  class="form-control" placeholder="montant" required min="0">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                    <button type="submit" class="btn btn-default btn-primary">
                        <span class="glyphicon glyphicon-ok"></span> Valider
                    </button>
                    &nbsp;
                    <button type="button" class="btn btn-default btn-primary"
                            onclick="javascript: window.location = 'getListeFrais';">
                        <span class="glyphicon glyphicon-remove"></span> Annuler</button>
                </div>
            </div>
            <div class="col-md-6 col-md-offset-3  col-sm-6 col-sm-offset-3">

            </div>
        </div>
    </div>

