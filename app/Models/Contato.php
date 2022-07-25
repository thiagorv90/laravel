<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contato extends Model
{
    protected $primaryKey = 'cdContato';
    use HasFactory;

    public $timestamps = false;

    public function telefone()
    {
        return $this->hasMany('App\Models\Telefone_contato');
    }

    public function instancia()
    {
        return $this->hasOne('App\Models\Instancia');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, fn($query, $search) => $query
            ->where('nmContato', 'like', '%' . $search . '%')
            ->orWhere('dsEmail', 'like', '%' . $search . '%'));
    }
}
