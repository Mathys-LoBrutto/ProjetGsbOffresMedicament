<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Medicament extends Model
{
    // On déclare la table visiteur
    protected $table = 'medicament';
    protected $primaryKey = "id_medicament";

    public $timestamps = false;
}
