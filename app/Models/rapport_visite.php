<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class rapport_visite extends Model{
    protected $table = 'rapport_visite';

    protected $primaryKey = 'id_rapport';

    public $timestamps = false;
}
