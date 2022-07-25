<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Telefone_contato extends Model
{
    protected $primaryKey = 'cdTelefone';
    use HasFactory;

    public $timestamps = false;

    public function contatos()
    {
        return $this->hasOne('App\Models\Contato');
    }
}
