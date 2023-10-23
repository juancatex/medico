<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'idrol',
        'name',
        'email',
        'password',
        'iddepartamento',
        'idprovincia',
        'genero',
        'ci',
        'fechanacimiento',
        'matricula',
        'telefono',
        'telfamiliar',
        'dir',
        'foto',
        'edad',
        'zona',
        'red',
        'idioma',
        'lengua',
        'autoidentificacion',
        'alfabeta',
        'estudios',
        'nivelanios',
        'estadocivil',
        'vivesola',
        'controlprenatalen',
        'partoen',
        'cip',
        'numhisclinico',
        'activo',
    ];
                           

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function controles():HasMany 
    {
        return $this->hasMany(ControlPrenatal::class,"iduser");
    }
    public function getmayor():HasOne 
    {
        return $this->hasOne(ControlPrenatal::class,"iduser")->ofMany('edadgest', 'max');
    }
    public function getante():HasOne 
    {
        return $this->hasOne(Antecedente::class,"iduser");
    }
    public function getgest():HasOne 
    {
        return $this->hasOne(GestacionActual::class,"iduser");
    }
}
