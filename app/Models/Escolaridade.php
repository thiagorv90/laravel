<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Escolaridade extends Model
{
    protected $primaryKey = 'cdEscolaridade';
    use HasFactory;

    public $timestamps = false;

    public function Escolaridade()
    {
        return $this->hasMany('App\Models\Escolaridade');
    }
}
