<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class FraisHF extends Model
{
    // On déclare la table Frais
    protected $table = 'fraishorsforfait';
    protected $primaryKey = "id_fraishorsforfait";

    public $timestamps = false;
}
