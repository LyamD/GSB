<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visite extends Model
{
    protected $table = 'visite';

    protected $fillable = [
        'dateMission',
        'motif',
        'bilan',
        'visiteurMedicaux_id',
        'utilisateurs_id'
    ];

    public function visiteur()
    {
        return $this->hasMany('App\VisiteurMedicaux', 'visiteurMedicaux_id');
    }
}
