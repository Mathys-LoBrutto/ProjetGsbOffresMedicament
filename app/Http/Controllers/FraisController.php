<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\dao\ServiceFrais;
use Exeption;


class FraisController extends Controller
{
    //
    public function getFraisVisiteur(){
        $erreur="";
        try {
            $id= Session::get('id');
            $serviceFrais= new serviceFrais;
            $mesFrais= $serviceFrais->getFrais($id);
            return view('vues/listeFrais' , compact('mesFrais'));
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

}
