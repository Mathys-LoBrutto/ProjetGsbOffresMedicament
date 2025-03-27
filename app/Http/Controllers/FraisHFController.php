<?php

namespace App\Http\Controllers;


use App\dao\ServiceFrais;
use App\dao\ServiceFraisHF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Exception;
use App\Models\FraisHF;

class FraisHFController extends Controller
{
    public function getFraisHF(){


            $erreur=Session::get('erreur');
            Session::forget('erreur');
            try {
                $id= Session::get('id');
                $serviceFraisHF= new ServiceFraisHF;
                $mesFraisHF= $serviceFraisHF->getFraisHF($id);
                $montant = 0;
                foreach ($mesFraisHF as $m){
                    $montant += $m->montant_fraishorsforfait;

                }
                return view('vues/listeFraisHF' , compact('mesFraisHF','montant', 'erreur'));
            } catch (Exception $e) {
                $erreur=$e->getMessage();
                return view('vues/error',compact('erreur'));
            }
        }

    public function updateFraisHF($id_frais)
    {
        $erreur = "";
        try {
            $serviceFraisHF= new serviceFraisHF;
            $unFraisHF = $serviceFraisHF->getByIdHF($id_frais);
            $titreVue = "Modfication d'une fiche de frais hors forfait";
            return view('vues/formFraisHF',compact('unFraisHF','titreVue'));
        } catch (Exception $e){
            $erreur=$e->getMessage();
            return view('vues/error',compact('erreur'));

        }
    }




    public function validerFraisHF(Request $request, $id){
        $erreur = "";
        try {

            $date_fraishorsforfait = $request->input('date_fraishorsforfait');
            $lib_fraishorsforfait = $request->input('lib_fraishorsforfait');
            $montant_fraishorsforfait = $request->input('montant_fraishorsforfait');


            $serviceFraisHF= new ServiceFraisHF;
            if($id > 0) {
                $serviceFraisHF->updateFraisHF($id, $date_fraishorsforfait, $lib_fraishorsforfait, $montant_fraishorsforfait);

            }else{
                $id_visiteur = Session::get('id');
                $serviceFraisHF->insertFraisHF($id, $date_fraishorsforfait,$lib_fraishorsforfait,$montant_fraishorsforfait);
            }
            return redirect('/getListeFraisHF/'.$id);
        }catch (Exception $e){
            $erreur=$e->getMessage();
            return view('vues/error',compact('erreur'));

        }
    }

}

