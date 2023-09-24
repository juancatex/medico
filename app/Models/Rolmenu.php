<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rolmenu extends Model
{
    use HasFactory;
    protected $fillable = ['idrol','idmenu'];
    protected $primaryKey = 'idrolmenu';  
}
