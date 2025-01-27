<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = new Category();
        $category->name = 'Decoración';
        $category->description = 'Articulos relacionados con la decoración del hogar';
        $category->slug="decoracion";
        $category->save();

        $category = new Category();
        $category->name = 'Motor';
        $category->description = 'Articulos relacionados con el mundo del motor';
        $category->slug="motor";
        $category->save();

        $category = new Category();
        $category->name = 'Deportes';
        $category->description = 'Articulos relacionados con el mundo del deporte';
        $category->slug="deportes";
        $category->save();

        $category = new Category();
        $category->name = 'Otros';
        $category->description = 'Aticulos que no encajan en las otras categorias';
        $category->slug="otros";
        $category->save();
    }
}
