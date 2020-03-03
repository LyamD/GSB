<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RespVisiteur extends Model
{
    protected $table = 'responsables';

    public $timestamps = false;

    protected $fillable = [
        'budgetAnnuel'
    ];

    public function visiteur()
    {
        return $this->belongsTo('App\VisiteurMedicaux', 'id');
    }
}
