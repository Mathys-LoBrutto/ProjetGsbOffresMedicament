<?php

namespace App\dao;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Exceptions\MonException;

class ServiceOffresMedicaments
{
    public function rechercherRapports($nomPraticien, $dateRapport)
    {
        try {
            $query = DB::table('rapport_visite')
                ->join('praticien', 'rapport_visite.id_praticien', '=', 'praticien.id_praticien')
                ->select('rapport_visite.*', 'praticien.nom_praticien');

            if (!empty($nomPraticien)) {
                $query->where('praticien.nom_praticien', 'LIKE', '%' . $nomPraticien . '%');
            }

            if (!empty($dateRapport)) {
                // Si l'utilisateur saisit une année (ex: 2023)
                if (strlen($dateRapport) == 4 && is_numeric($dateRapport)) {
                    $query->whereYear('rapport_visite.date_rapport', $dateRapport);
                } else {
                    // Sinon, on considère que c’est une date complète
                    $query->whereDate('rapport_visite.date_rapport', $dateRapport);
                }
            }

            return $query->get();
        } catch (QueryException $e) {
            throw new MonException($e->getMessage());
        }
    }

    public function getListePraticiens()
    {
        try {
            $mespraticiens= DB::table('praticien')
                ->select('id_praticien', 'nom_praticien', 'prenom_praticien')
                ->orderBy('nom_praticien')
                ->get();

            return $mespraticiens;

        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }

    public function getListeVisiteurs()
    {
        try {
            $mesvisiteurs = DB::table('visiteur')
                ->select('id_visiteur', 'nom_visiteur', 'prenom_visiteur')
                ->orderBy('nom_visiteur')
                ->get();

            return $mesvisiteurs;

        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }

    public function getPraticienById($id)
    {
        try {
            $MonPraticien = DB::table('praticien')
                ->select()
                ->where('id_praticien', $id)
                ->first();

            return $MonPraticien;
        } catch (QueryException $e) {
            throw new MonException($e->getMessage());
        }
    }

    public function ajouterRapport($visiteurId, $praticienId, $date, $motif, $bilan, /*$medicament_offert, $qte*/)
    {
        try {
            DB::table('rapport_visite')->insert([
                'id_visiteur' => $visiteurId,
                'id_praticien' => $praticienId,
                'date_rapport' => $date,
                'motif' => $motif,
                'bilan' => $bilan,
            ]);

//            DB::table('offrir')->insert([
//                'id_medicament' => $medicament_offert,
//                'id_rapport' => ,
//                'qte_offerte' => $qte,
//            ])


        } catch (QueryException $e) {
            throw new MonException($e->getMessage());
        }
    }

    public function ajouterMedicamentOffert($medicament_offert, $id_rapport, $qte){
        try {
            DB::table('offrir')->insert([
                'id_medicament' => $medicament_offert,
                'id_rapport' => $id_rapport,
                'qte_offerte' => $qte
            ]);
        }catch (QueryException $e) {
            throw new MonException($e->getMessage());
        }

    }

    public function MesMedicaments($id_rapport){
        try {
            $mesMedicaments = DB::table('offrir')
                ->select('offrir.id_medicament', 'nom_commercial', 'qte_offerte' , 'id_rapport')
                ->join('medicament', 'medicament.id_medicament', '=', 'offrir.id_medicament')
                ->where('id_rapport', $id_rapport)
                ->get();

            return $mesMedicaments;
        }catch (QueryException $e) {
            throw new MonException($e->getMessage());
        }

    }


    public function deleteMedicament($id)
    {
        try {
            DB::table('offrir')->where('id_medicament', $id)->delete();

        } catch (QueryException $e) {
            throw new MonException($e->getMessage());
        }
    }

    public function getOffreParId($id_medicament, $id_rapport)
    {

        try {
            $monOffre = DB::table('offrir')
                ->select('qte_offerte' , 'offrir.id_medicament' , 'id_rapport', 'nom_commercial') // ou d'autres colonnes
                ->join('medicament', 'medicament.id_medicament', '=', 'offrir.id_medicament')
                ->where('offrir.id_medicament', $id_medicament)
                ->where('id_rapport', $id_rapport)
                ->first();
            return $monOffre;
        }catch (QueryException $e) {
            throw new MonException($e->getMessage());
        }
    }



    public function getMedicamentByName($nom_commercial){
        try {
            $monMedicament = DB::table('medicament')
                ->select('id_medicament', 'nom_commercial')
                ->where('nom_commercial', $nom_commercial)
                ->first();
            return $monMedicament;
        }catch (QueryException $e) {
            throw new MonException($e->getMessage());
        }

    }

//    public function updateMedicament($id_medicament, $qte_offerte){
//        try {
//            DB::table('offrir')
//                ->where('id_rapport', Session::get('id_rapport'))
//                ->update(['id_medicament'=>$id_medicament,
//                    'qte_offerte'=>$qte_offerte]);
//        }catch (QueryException $e) {
//            throw new MonException($e->getMessage());
//        }
//
//    }
    public function updateOffre($id_rapport, $ancien_id_medicament, $nouvel_id_medicament, $qte_offerte)
    {
        DB::table('offrir')
            ->where('id_rapport', $id_rapport)
            ->where('id_medicament', $ancien_id_medicament)
            ->update([
                'id_medicament' => $nouvel_id_medicament,
                'qte_offerte' => $qte_offerte
            ]);
    }


    public function getMedicament()
    {
        try {
            $medicament = DB::table('medicament')
                ->select('id_medicament', 'nom_commercial')
                ->get();
            return $medicament;

        }catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }

    }




}

