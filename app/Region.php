<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $table = 'Regions';

    public $timestamps = false;

    protected $attributes = [
        'nomRegion',
        'BudgetGlobalAnnuel'
    ];

    public function responsable()
    {
        return $this->belongsTo('App\User', 'utilisateurs_id');
    }
}
