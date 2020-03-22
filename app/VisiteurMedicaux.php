<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Passage;

class VisiteurMedicaux extends Model
{
    protected $table = 'visiteurmedicaux';

    public $timestamps = false;

    protected $fillable = [
        'objectif',
        'prime',
        'avantages',
        'budget',
    ];

    //Liens avec les roles

    public function employe()
    {
        return $this->belongsTo('App\User', 'id', 'id');
    }

    public function responsable()
    {
        if ($this->hasRole('responsable')) {
            return $this->hasOne('App\Responsables', 'id');
        } else {
            return null;
        }
    }

    public function getRegionActuelle()
    {
        $passage = Passage::where([ 'utilisateurs_id' => $this['id'], 'dateFin' => null ])->first();
        return $passage['regions_id'];
    }

    // ----
}
