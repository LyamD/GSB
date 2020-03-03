<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

    public function employe()
    {
        return $this->belongsTo('App\User', 'id');
    }

    public function responsable()
    {
        if ($this->hasRole('respVisiteur')) {
            return $this->hasOne('App\RespVisiteur', 'id');
        } else {
            return null;
        }
    }
}
