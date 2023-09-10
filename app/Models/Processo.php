<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Processo extends Model
{
    use HasFactory;

    protected $fillable = [
        'collaborator_id',
        'processo',
        'descricao',
        'sistemas',
        'sensiveis',
        'tempo',
        'bases',
        'dados'
    ];

    public function Collaborators() : BelongsTo
    {
        return $this->belongsTo(Collaborators::class);
    }

     public function setDadosAttribute($value)
    {
        $this->attributes['dados'] = json_encode($value);
    }

    public function getDadosAttribute($value)
    {
        return json_decode($value, true);
    }


    
    // public function setBaseAttribute($v)
    // {
    //     $this->attributes['base'] = json_encode($v);
    // }

    // public function getBaseAttribute($v)
    // {
    //     return json_decode($v, true);
    // }
}
