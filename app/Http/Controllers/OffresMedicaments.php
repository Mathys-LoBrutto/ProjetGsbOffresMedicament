<?php

namespace App\Http\Controllers;

use App\dao\ServiceOffresMedicaments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\dao\ServiceVisiteur;
use Exeption;
use MongoDB\Driver\Exception\Exception;
use function Laravel\Prompts\error;

class OffresMedicaments extends Controller
{
    public function AfficherFormRecherche(){



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

    public function AfficherFormAjoutMedicamentOffert($rapport){
        $service = new ServiceOffresMedicaments();
        $medicaments = $service->getMedicament();

        return view('vues/formAjoutMedicamentOffert', compact('rapport' , 'medicaments'));
    }


    public function ajouterRapport(Request $request)
    {
        try {
            $service= new ServiceOffresMedicaments();
            $service->ajouterRapport(
                $request->visiteur_id,
                $request->praticien_id,
                $request->date_rapport,
                $request->motif,
                $request->bilan,
                /*
                $request->medicament_offert,
                $request->qte*/
            );

            return redirect('/formRechercheRapport')->with('success', 'Offre mise à jour avec succès.');
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('error', compact('erreur'));
        }
    }

    public function ajoutMedicamentOffert(Request $request){
        try {
            $service= new ServiceOffresMedicaments();
            $id_rapport = $request->id_rapport;



            $service->ajouterMedicamentOffert(
                $request->medicament_offert,
                $request->id_rapport,
                $request->qte


            );

            return redirect("medicament/{$id_rapport}")->with('success', 'Offre mise à jour avec succès.');

        }catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('error', compact('erreur'));
        }
    }

    public function showMedicament($rapport){
        $Monservice = new ServiceOffresMedicaments();
        $MesMedicaments = $Monservice -> MesMedicaments($rapport);


        return view('vues/showMedicamentsRapport' , compact('MesMedicaments' , 'rapport'));

    }

    public function destroy($id, $id_rapport)
    {
        $medicamentService = new ServiceOffresMedicaments();
        $result = $medicamentService->deleteMedicament($id);

//        if ($result) {
            return redirect("medicament/{$id_rapport}");
//        }

//        return redirect('formRechercheRapport');
    }

    public function edit($id_medicament, $id_rapport)
    {
        $medicamentService = new ServiceOffresMedicaments();
        $medicaments = $medicamentService->getMedicament();
        $monOffre = $medicamentService->getOffreParId($id_medicament, $id_rapport);


        return view('vues/editMedicament', compact('monOffre', 'medicaments'));
    }

    public function update(Request $request)
    {
        $medicamentService = new ServiceOffresMedicaments();

        $id_rapport = $request->input('id_rapport');
        $id_medicament_actuel = $request->input('id_medicament_actuel');
        $nouveau_nom = $request->input('medicament_offert');
        $nouvelle_qte = $request->input('qte_offerte');

        // Récupérer le nouvel ID médicament depuis le nom saisi
        $nouveauMedicament = $medicamentService->getMedicamentByName($nouveau_nom);
        $nouvel_id_medicament = $nouveauMedicament->id_medicament;

        // Mettre à jour
        $medicamentService->updateOffre(
            $id_rapport,
            $id_medicament_actuel,
            $nouvel_id_medicament,
            $nouvelle_qte
        );

        return redirect("medicament/{$id_rapport}")->with('success', 'Offre mise à jour avec succès.');
    }

}
