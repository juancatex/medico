<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ControlPrenatal extends Model
{
    use HasFactory;
    protected $fillable = ['iduser','asisfecha','peso','imc','pa','edadgest','alturauterina','presentacion','fcf','movimfetales','proteinuria','numtabferroso','tratamientos','responsable','proximacita','activo'];
    protected $primaryKey = 'idprenat'; 
           
}
