@extends('layouts.master')
@section('content')

    <div class="container">
        <div class="blanc">
            <h1>Liste des fiches de frais hors forfait</h1>
        </div>
        <table class="table table-bordered table-striped">
            <thread>
                <tr>
                    <th>Date</th>
                    <th>libellé</th>
                    <th>montant</th>
                    <th>modifier</th>
                    <th>Supprimer</th>

                </tr>
            </thread>
            <tbody>
            @foreach($mesFraisHF as $unFraisHF)
                <tr>
                    <td> {{$unFraisHF->date_fraishorsforfait}}</td>
                    <td> {{$unFraisHF->lib_fraishorsforfait}}</td>
                    <td> {{$unFraisHF->montant_fraishorsforfait}}</td>

                    <td style="text-align:center;">
                        <a href="{{ url ('/modifierFraisHF') }}/{{$unFraisHF->id_fraishorsforfait}}">
                            <span class="glyphicon glyphicon-pencil"
                                  data-toggle="tooltip" data-placement="top" title="Modifier">

                            </span></a></td>

                    <td style="text-align:center;">
                        <a  onclick="javascript:if (confirm('Suppression confirmée ?')) {
                    window.location='{{'/supprimerFrais'}}/{{$unFraisHF->id_frais}}'}">
                        <span class="glyphicon glyphicon-remove"
                              data-toggle="tooltip" data-placement="top" title="Supprimer">

                        </span></a></td>
                </tr>
            @endforeach

            <tr>
                <td colspan="2" style="text-align:right;"><strong>Montant total</strong></td>
                <td colspan="3">{{ $montant }} €</td>
            </tr>
            </tbody>
        </table>


        <div class="form-group">
            <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                <a href=""><button type="button" class="btn btn-default btn-primary"><span class="glyphicon glyphicon-plus"></span> Ajouter</button></a>
                <a href=""><button type="button" class="btn btn-default btn-primary"><span class="glyphicon glyphicon-ok"></span> valider les montants</button></a>
                <a href="{{ url ('/modifierFrais') }}/{{$unFraisHF->id_frais}}"><button type="button" class="btn btn-default btn-primary"><span class="glyphicon glyphicon-remove"></span> Annuler</button></a>
            </div>
        </div>
        @include('vues/error')
    </div>
@stop
