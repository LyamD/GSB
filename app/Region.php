<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $table = 'regions';

    public $timestamps = false;

    protected $fillable = [
        'nomRegion',
        'budgetGlobalAnnuel'
    ];

    public function responsable()
    {
        return $this->belongsTo('App\User', 'utilisateurs_id');
    }

    public function employee()
    {
        return $this->belongsToMany('App\User', 'estpasser', 'regions_id', 'utilisateurs_id')->withPivot('dateDebut', 'dateFin');
    }
}
