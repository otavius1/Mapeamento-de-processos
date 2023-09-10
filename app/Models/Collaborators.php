<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Collaborators extends Model
{
    use HasFactory;
    protected $table = 'collaborators';

    protected $fillable = [
        'name',
        'email',
        'matricula',
        'setor',
        'status'
    ];

    public function processos() : HasMany
    {
        return $this->hasMany(Processo::class, 'collaborator_id', 'id');
    }
}

