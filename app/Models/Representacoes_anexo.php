<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Representacoes_anexo extends Model
{
    protected $primaryKey = 'cdAnexo';
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;


    public function representacoe()
    {
        return $this->hasOne('App\Models\Representacoes');
    }

}
