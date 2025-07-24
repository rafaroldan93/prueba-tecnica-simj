<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    protected $fillable = [
        'proyecto_id',
        'user_id',
        'inicio',
        'fin',
        'descripcion'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class);
    }
}
