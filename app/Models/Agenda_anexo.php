<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda_anexo extends Model
{
    protected $primaryKey = 'cdAgenda';
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;


    public function representacoe()
    {
        return $this->hasOne('App\Models\Agenda');
    }

}
