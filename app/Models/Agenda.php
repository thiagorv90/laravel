<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class agenda extends Model
{
    protected $primaryKey = 'cdAgenda';
    use HasFactory;

    public $timestamps = false;
    protected $dates = ['dtAgenda'];

    public function representacoe()
    {
        return $this->hasMany('App\Models\Representacoe');
    }
}
