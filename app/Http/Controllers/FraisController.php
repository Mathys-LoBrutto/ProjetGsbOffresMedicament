<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\dao\ServiceFrais;
use Exception;
use App\Models\Frais;

class FraisController extends Controller
{
    //
    public function getFraisVisiteur(){
        $erreur=Session::get('erreur');
        Session::forget('erreur');
        try {
            $id= Session::get('id');
            $serviceFrais= new serviceFrais;
            $mesFrais= $serviceFrais->getFrais($id);
            return view('vues/listeFrais' , compact('mesFrais', 'erreur'));
        } catch (Exception $e) {
            $erreur=$e->getMessage();
            return view('vues/error',compact('erreur'));
        }
    }


    public function updateFrais($id_frais)
    {
        $erreur = "";
        try {
            $serviceFrais= new serviceFrais;
            $unFrais = $serviceFrais->getById($id_frais);
            $titreVue = "Modfication d'une fiche de frais";
            return view('vues/formFrais',compact('unFrais','titreVue'));
        } catch (Exception $e){
            $erreur=$e->getMessage();
            return view('vues/error',compact('erreur'));

        }
    }

    public function validerFrais(Request $request){
        $erreur = "";
        try {
            $id_frais = $request->input('id_frais');
            $anneemois = $request->input('anneemois');
            $nbjustificatif = $request->input('nbjustificatif');
            $serviceFrais= new ServiceFrais;
            if($id_frais > 0){
                $serviceFrais->updateFrais($id_frais,$anneemois,$nbjustificatif);
            }else{
                $id_visiteur = Session::get('id');
                $serviceFrais->insertFrais($id_visiteur,$anneemois,$nbjustificatif);
            }
            return redirect('getListeFrais');
        }catch (Exception $e){
            $erreur=$e->getMessage();
            return view('vues/error',compact('erreur'));

        }
    }

    public function addfrais(){
        $erreur = "";
        try {
            $unFrais = new Frais();
            $unFrais->id_frais = 0;
            $titreVue = "Création d'une fiche de frais";
            return view('vues/formFrais',compact('unFrais','titreVue'));
        }catch (Exception $e){
            $erreur=$e->getMessage();
            return view('vues/error',compact('erreur'));
        }
    }

    public function removeFrais($id_frais){
        try {
            $serviceFrais= new ServiceFrais();
            $serviceFrais->deleteFrais($id_frais);
            return redirect('getListeFrais');
            } catch (Exception $e) {
            Session::put('erreur', $e->getMessage());
        }
        return redirect('getListeFrais');

    }

}
