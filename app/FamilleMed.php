<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FamilleMed extends Model
{
    protected $table = 'famillemedicament';

    public $timestamps = false;

    protected $fillable = [
        'nomFamille'
    ];

    

    
}
