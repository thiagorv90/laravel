<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instituicoe extends Model
{
    protected $primaryKey = 'cdInstituicao';
    use HasFactory;
    public $timestamps = false;

    public function tipoinsta(){
        return $this->hasOne('App\Models\Tipo_instancia');
    }
    public function instancia(){
        return $this->hasMany('App\Models\Instancia');
    }
}
