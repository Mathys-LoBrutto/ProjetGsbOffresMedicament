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
                $query->whereDate('rapport_visite.date_rapport', $dateRapport);
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

    public function ajouterRapport($visiteurId, $praticienId, $date, $motif, $bilan)
    {
        try {
            DB::table('rapport_visite')->insert([
                'id_visiteur' => $visiteurId,
                'id_praticien' => $praticienId,
                'date_rapport' => $date,
                'motif' => $motif,
                'bilan' => $bilan,

            ]);
        } catch (QueryException $e) {
            throw new MonException($e->getMessage());
        }
    }

////    public function MesMedicaments($id_rapport){
////        try {
////            DB::table('offrir')
////                ->select('id_medicament', 'nom_commercial')
////                ->
////                ->where('id_rapport', $id_rapport)
////        }
//
//    }
}

