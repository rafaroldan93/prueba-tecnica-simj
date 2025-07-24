<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    protected $fillable = [
        'nombre',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tareas()
    {
        return $this->hasMany(Tarea::class);
    }
}
