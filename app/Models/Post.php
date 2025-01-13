<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    //
    use HasFactory;

    protected function cast(): array
    {
        return [
            'published_at' => 'datetime',
            'is_active' => 'boolean',
        ];
    }
    protected function title(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ucfirst($value),
        );
    }

    public function getDesdeAttribute(): string
    {
        // Devuelve los primeros 100 caracteres de 'content', o todo el contenido si tiene menos de 100 caracteres
        return $this->created_at->diffForHumans();
    }


    public function getResumenAttribute(): string
    {
        // Devuelve los primeros 100 caracteres de 'content', o todo el contenido si tiene menos de 100 caracteres
        return substr($this->content, 0, 200).'...';
    }
}
