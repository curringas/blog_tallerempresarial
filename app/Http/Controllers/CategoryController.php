<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    //**********************************************************
    //  *** CRUD ****
    //********************************************************** 
    public function index(Request $request)
    {
        $categories=Category::orderBy('name', 'asc')->paginate(5);
        $user = $request->user();
        return view('categories.index', compact('categories','user'));
    }

    public function show(Category $category, Request $request)
    {   
        if($category){
            //$user=User::find($id);
            $user = $request->user();
            return view('categories.show',compact('category','user'));
        }else{
            return redirect()->route('dashboard');
        }
    }

    public function create(Request $request)
    {
        $user=$request->user();
        //dd($user->profile);
        if ($user->profile!="administrator"){
            return redirect()->route('dashboard');
        }
        //Definimos las variables para mandar al formulario de editar que seral el mismo que crear
        $id=null;
        $category = null;
        $title = 'Crear Categoría';
        $subtitle = 'Aqui puedes crear una nueva categoría';
        $route = 'categories.store';
        return view('categories.edit',compact('category','title','subtitle','route'));
    }

    public function edit(Category $category, Request $request)
    {
        $user=$request->user();
        if ($user->profile!="administrator"){
            return redirect()->route('dashboard');
        }
        //Definimos las variables para mandar al formulario de editar que seral el mismo que crear
        //$user=User::find($id);
        $title = 'Editar Categoría';
        $subtitle = 'Aqui puedes modificar esta categoría';
        $route = "categories.update";
        return view('categories.edit',compact('category','title','subtitle','route'));
    }

    public function store(Request $request)
    {
        $user=$request->user();
        //dd($user->profile);
        if ($user->profile!="administrator"){
            return redirect()->route('dashboard');
        }

        // Validación de los datos del formulario
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'slug' => ['required','string','max:255',
                        'unique:categories,slug',  // Valida que el slug sea único en la tabla "categories"
                        'regex:/^[a-z0-9-]+$/',  // Valida que el slug solo tenga minúsculas, números y guiones
                        ],
            'description' => 'nullable|string',  // Validación para la descripción (opcional)
        ]);

        // Si la validación pasa, puedes guardar el usuario
        Category::create($validatedData);
        /*Category::create([
            'name' => $validatedData['name'],
            'slug' => $validatedData['slug'],
            'description' => $validatedData['slug'],
        ]);*/

        // Redirigir o devolver una respuesta
        return redirect()->route('categories.index')->with('success', 'Categoría creada con éxito!');

    }

    public function update(Request $request, Category $category)
    {
        //dd($lector);
        $user=$request->user();
        if ($user->profile!="administrator"){
            return redirect()->route('dashboard');
        }
        // Validación para la actualización
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'slug' => ['required','string','max:255',
                        'unique:categories,slug,'. $category->id,  // Valida que el slug sea único en la tabla "categories"
                        'regex:/^[a-z0-9-]+$/',  // Valida que el slug solo tenga minúsculas, números y guiones
                        ],
            'description' => 'nullable|string',  // Validación para la descripción (opcional)
        ]);

        //$user=User::find($id);
        if (!$category) {
            return redirect()->route('dashboard');
        }else{

            $category->update($validatedData);
            /*$category->name = $validatedData['name'];
            $category->slug = $validatedData['slug'];
            $category->description = $validatedData['description'] ?? $category->description; 
            $category->save();*/
            return redirect()->route('categories.index')->with('success', 'Categoría actualizada con éxito!');
        }
    }

    public function destroy(Category $category, Request $request)
    {
        $user=$request->user();
        if ($user->profile!="administrator"){
            return redirect()->route('dashboard');
        }
        //$user=User::find($id);
        $category->delete();
        return redirect()->route('categories.index');
    }
}
