<?php

namespace App\Medicaments;

use Illuminate\Database\Eloquent\Model;

class Medicaments extends Model
{
    protected $table = 'medicaments';
    protected $primaryKey = 'numeroProduit';

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nomCommercial',
        'effets',
        'contreIndications',
        'prixEchantillon',
    ];
}
