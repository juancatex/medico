<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GestacionActual extends Model
{
    use HasFactory;
    protected $fillable = ['iduser'];
        protected $primaryKey = 'idgesact';  
}
