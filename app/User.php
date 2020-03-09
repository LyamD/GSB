<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    protected $table = 'utilisateurs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'nom', 'prenom', 'dateNaissance', 'adresse', 'adresse2', 'CP', 'ville',
        //Si Employée
        'matricule', 'dateEmbauche'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function regions()
    {
        return $this->belongsToMany('App\Region', 'estpasser', 'utilisateurs_id', 'regions_id')->withPivot('dateDebut', 'dateFin');
    }

    
    public function isInRegion($id)
    {
        $region = $this->regions()->find($id);
        if (empty($region->pivot->dateFin)) {
            return true;
        } else {
            return false;
        }
        
    }

    public function dirige()
    {
        if ($this->hasRole('responsable')) {
            return $this->hasMany('App\Region', 'utilisateurs_id');
        } else {
            return null;
        }
        
    }

    //Liens avec les roles

    public function visiteurMedicaux()
    {
        if ($this->hasRole('visiteurMedicaux')) {
            return getVisiteurMed();
        } else {
            return null;
        }
    }

    private function getVisiteurMed() {
        return $this->hasOne('App\VisiteurMedicaux', 'id');
    }

    public function responsable()
    {
        if ($this->hasRole('responsable')) {
            return getVisiteurMed()->responsable();
        } else {
            return null;
        }
    }

    // ----

}
