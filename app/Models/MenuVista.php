<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuVista extends Model
{
    use HasFactory;
    protected $fillable = ['idmenu','idv'];
    protected $primaryKey = 'idmenuvista';  
     
}
