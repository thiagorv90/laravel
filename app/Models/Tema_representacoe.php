<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tema_representacoe extends Model
{
    protected $primaryKey = 'cdTema';
    use HasFactory;
    public $timestamps = false;
}
