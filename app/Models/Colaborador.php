<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Colaborador extends Model
{
    protected $table = 'colaboradores_nomes'; 
    protected $fillable = ['nome']; 
}
