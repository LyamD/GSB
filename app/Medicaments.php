<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicaments extends Model
{
    protected $table = 'medicaments';

    protected $fillable = [
        'numeroProduit',
        'nomCommercial',
        'effets',
        'contreIndications',
        'prixEchantillon',
        'familleMedicament_id'
    ];

    public function famille()
    {
        return $this->belongsTo('App\FamilleMed', 'familleMedicament_id');
    }

}
