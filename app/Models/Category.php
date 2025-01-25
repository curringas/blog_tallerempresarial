<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable = ['name','slug','description'];

    public function getResumenAttribute(): string
    {
        // Devuelve los primeros 100 caracteres de 'content', o todo el contenido si tiene menos de 100 caracteres
        return substr($this->description, 0, 200).'...';
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
