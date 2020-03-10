<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Responsables extends Model
{
    protected $table = 'responsables';

    public $timestamps = false;

    //Liens avec les roles

    public function visiteur()
    {
        return $this->belongsTo('App\VisiteurMedicaux', 'id');
    }

    public function user() {
        return visiteur()->employe();
    }

    //----
}
