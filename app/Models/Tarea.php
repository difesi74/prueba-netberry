<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    use HasFactory;

    /**
     * Las categorias asociadas a la tarea
     */
    public function categorias()
    {
        return $this->belongsToMany(Categoria::class, 'tareas_categorias');
    }
}
