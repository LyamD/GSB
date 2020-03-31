<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interaction extends Model
{
    protected $table = 'melange';

    public $timestamps = false;

    protected $fillable = [
        'numeroProduit',
        'numeroProduit_1',
        'interaction'
    ];
}
