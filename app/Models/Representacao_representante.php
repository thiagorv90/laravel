<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Representacao_representante extends Model
{
    use HasFactory;
    protected $primaryKey = 'cdRepSup';
    protected $fillable = ['cdRepSup']; 

    public function representacoes()
    {
        return $this->hasOne('App\Models\Representacoes');
    }
    public function representante()
    {
        return $this->hasOne('App\Models\Representante_suplentes');
    }
    public $timestamps = false;
}
