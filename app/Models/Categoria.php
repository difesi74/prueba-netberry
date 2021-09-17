<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    /**
     * Las tareas asociadas a la categoria
     */
    public function tareas()
    {
        return $this->belongsToMany(Tarea::class, 'tareas_categorias');
    }
}
