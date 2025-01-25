<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //Para la asignacion masiva
    protected $fillable = ['name','slug','description'];
    //En lugar de lo anterior se puede usar lo contrario
    //protected $guarded = ['id']; 
    //y asi se protege el id y no se puede modificar o otros campos que no se quieran modificar
    //y esten definidos en la bd con un valor por defecto
    
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
