<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antecedente extends Model
{
    use HasFactory;
    protected $fillable = ['iduser','tbcf','tbcp','diabetesf','diabetesp','hipertensionf','hipertensionp','preeclampsiaf','preeclampsiap'
,'eclampsiaf','eclampsiap','otrof','otrop','cirtracto','infertilidad','cardiopat','nefropatia','violencia','vih','ultimoprevions','ultimoprevionormal',
'antecedentesgemelares','tresconsecutivos','gestasprevias','ectopico','partos','abortos','vaginales','cesareas','nacidosvivos','nacidosmuertos','muertossemana',
'muertosdespuessemana','viven','finembarazoanterior','embarazoplaneado','fracasometodo'];
    protected $primaryKey = 'idantecedente';  
        
}
