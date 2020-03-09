<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Responsables extends Model
{
    protected $table = 'responsables';

    public $timestamps = false;

    public function visiteur()
    {
        return $this->belongsTo('App\VisiteurMedicaux', 'id');
    }
}
