<?php

namespace App\Http\Controllers;

use App\dao\ServiceOffresMedicaments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\dao\ServiceVisiteur;
use Exeption;
use MongoDB\Driver\Exception\Exception;

class OffresMedicaments extends Controller
{
    public function AfficherFormRecherche(){
        $Monservice = new ServiceOffresMedicaments();


        return view('vues/formRechercheRapport');
    }

    public function AfficherRapportVisite(Request $request)
    {
        try {
            $serviceRapport = new ServiceOffresMedicaments();
            $rapports = $serviceRapport->rechercherRapports(
                $request->nom_praticien,
                $request->date_rapport
            );

            return view('vues/formRechercheRapport', compact('rapports'));
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }
    }

    public function AfficherFormAjout(){
        $service = new ServiceOffresMedicaments();
        $praticiens = $service->getListePraticiens();
        $visiteurs = $service->getListeVisiteurs();

        return view('vues/formAjoutRapport', compact('praticiens', 'visiteurs'));
    }


    public function ajouterRapport(Request $request)
    {
        try {
            $serviceRapport = new ServiceRapport();
            $serviceRapport->ajouterRapport(
                $request->visiteur_id,
                $request->praticien_id,
                $request->date_rapport,
                $request->motif,
                $request->bilan,
            );

            return redirect('/listeRapports')->with('success', 'Rapport ajouté avec succès!');
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('error', compact('erreur'));
        }
    }

    public function showMedicament($rapport){
        $Monservice = new ServiceOffresMedicaments();
        $MesMedicaments = $Monservice -> MesMedicaments($rapport);


        return view('vues/showMedicamentsRapport' , compact('MesMedicaments'));

    }

}
