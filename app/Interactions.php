<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interactions extends Model
{
    protected $table = 'melange';
    public $timestamps = false;

    protected $fillable = [
        'Produit_id',
        'Produit_1_id',
        'interaction'
    ];

}
