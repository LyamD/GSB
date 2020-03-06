<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specialites extends Model
{
    protected $table = 'specialites';

    public $timestamps = false;

    protected $fillable = [
        'nomSpecialite'
    ];

    public function practiciens(Type $var = null)
    {
        return $this->belongsToMany('App\User', 'specialise', 'specialites_id', 'utilisateurs_id');
    }
}
