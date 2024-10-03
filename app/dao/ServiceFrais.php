<?php

namespace app\dao;

use App\Models\Frais;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Exceptions\MonException;

class ServiceFrais
{
    public function getFrais($id_visiteur)
    {
        try{
            $lesFrais = DB::table('frais')
                ->select()
                ->where('id_visiteur', '=', $id_visiteur)
                ->orderBy('anneemois', 'DESC')
                ->get();
                return $lesFrais;

        }catch (QueryException $e){
            throw new MonException($e->getMessage(), 5);
        }
    }

    public function getById($id_frais)
    {

    }
}

