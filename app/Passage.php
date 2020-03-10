<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Passage extends Model
{
    protected $table = 'estpasser';

    public $timestamps = false;

    protected $fillable = [
        'utilisateurs_id',
        'regions_id',
        'dateDebut',
        'dateFin'
    ];
}
