<?php

namespace App\dao;

use App\Models\FraisHF;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Exceptions\MonException;

class ServiceFraisHF
{
    public function getFraisHF($id_frais)
    {
        try{
            $lesFrais = DB::table('fraishorsforfait')
                ->select()
                ->where('id_frais', '=', $id_frais)
                ->orderBy('date_fraishorsforfait', 'DESC')
                ->get();
            return $lesFrais;

        }catch (QueryException $e){
            throw new MonException($e->getMessage(), 5);
        }
    }

    public function getById($id_fraisHF)
    {
        try{
            $unFraisHF = DB::table('fraishorsforfait')
                ->select()
                ->where('id_fraishorsforfait', '=', $id_fraisHF)
                ->first();
            return $unFraisHF;
        }catch (QueryException $e){
            throw new MonException($e->getMessage());
        }
    }

    public function updatefraishf($id_fraishorsforfait,$date_fraishorsforfait,$lib_fraishorsforfait,$montant_fraishorsforfait,)
    {
        try{
            DB::table('fraishorsforfait')
                ->where('id_fraishorsforfait','=',$id_fraishorsforfait)
                ->update(['date_fraishorsforfait'=>$date_fraishorsforfait,'lib_fraishorsforfait'=>$lib_fraishorsforfait ,'montant_fraishorsforfait'=>$montant_fraishorsforfait]);
        }catch (QueryException $e){
            throw new MonException($e->getMessage());
        }
    }


    public function getByIdHF($id_fraishorsforfait){
        try {
            $lesFraisHF = DB::table('fraishorsforfait')
                ->select()
                ->where('id_fraishorsforfait', '=', $id_fraishorsforfait)
                ->first();
            return $lesFraisHF;
        }catch (QueryException $e){
            throw new MonException($e->getMessage());
        }
    }

    public function insertFraisHF($id_fraishorsforfait, $date_fraishorsforfait, $lib_fraishorsforfait, $montant_fraishorsforfait){
        try {
            DB::table('fraishorsforfait')
                ->insert(['id_fraishorsforfait'=>$id_fraishorsforfait,'date_fraishorsforfait'=>$date_fraishorsforfait, 'lib_fraishorsforfait'=>$lib_fraishorsforfait, 'montant_fraishorsforfait'=>$montant_fraishorsforfait]);

        }catch (QueryException $e){
            throw new MonException($e->getMessage());
        }
    }




}

