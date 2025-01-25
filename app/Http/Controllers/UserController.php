<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //**********************************************************
    //  *** CRUD ****
    //********************************************************** 
    public function index(Request $request)
    {
        $lectores=User::where('profile','lector')->orderBy('created_at', 'desc')->paginate(3);
        $user = $request->user();
        return view('users.index', compact('lectores','user'));
    }

    public function show(User $lector, Request $request)
    {   
        if($lector){
            //$user=User::find($id);
            $user = $request->user();
            return view('users.show',compact('lector','user'));
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
        $lector = null;
        $title = 'Crear Lector';
        $subtitle = 'Aqui puedes crear un nuevo lector';
        $route = 'users.store';
        return view('users.edit',compact('lector','title','subtitle','route'));
    }

    public function edit(User $lector, Request $request)
    {
        $user=$request->user();
        if ($user->profile!="administrator"){
            return redirect()->route('dashboard');
        }
        //Definimos las variables para mandar al formulario de editar que seral el mismo que crear
        //$user=User::find($id);
        $title = 'Editar Usuario';
        $subtitle = 'Aqui puedes modificar este usuario';
        $route = "users.update";
        return view('users.edit',compact('lector','title','subtitle','route'));
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
            'email' => 'required|email|unique:users,email',
            'telephone' => 'nullable|numeric', // Puede ser nulo y debe ser numérico
            'password' => 'required|min:8|confirmed',
        ]);

        // Si la validación pasa, puedes guardar el usuario
        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'telephone' => $validatedData['email'] ?? null,
            'password' => bcrypt($validatedData['password']),
        ]);

        // Redirigir o devolver una respuesta
        return redirect()->route('users.index')->with('success', 'Usuario creado con éxito!');


        /*$lector = new User();
        $lector->name = $request->name;
        $lector->email = $request->email;
        $lector->telephone = $request->telephone;
        $lector->password = bcrypt($request->password);
        $lector->save();
        return redirect()->route('dashboard');*/
    }

    public function update(Request $request, User $lector)
    {
        //dd($lector);
        $user=$request->user();
        if ($user->profile!="administrator"){
            return redirect()->route('dashboard');
        }
        // Validación para la actualización
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . $lector->id,  // Excluye el usuario actual en la validación
            'password' => 'nullable|min:8|confirmed',  // La contraseña es opcional
            'telephone' => 'nullable|numeric',  // Teléfono opcional
        ]);

        //$user=User::find($id);
        if (!$lector) {
            return redirect()->route('dashboard');
        }else{

            $lector->name = $validatedData['name'];
            $lector->email = $validatedData['email'];
            $lector->telephone = $validatedData['telephone'] ?? $lector->telephone;  // Si no se proporciona un nuevo teléfono, se mantiene el anterior
            if ($request->filled('password')) {
                $lector->password = bcrypt($validatedData['password']);  // Solo se actualiza si se proporciona una nueva contraseña
            }
            $user->save();
            return redirect()->route('users.index')->with('success', 'Usuario actualizado con éxito!');
            /*$lector->name = $request->name;
            $lector->email = $request->email;
            $lector->telephone = $request->telephone;
            $lector->update();
            return redirect()->route('users.show',$lector);*/
        }
    }

    public function destroy(User $lector, Request $request)
    {
        $user=$request->user();
        if ($user->profile!="administrator"){
            return redirect()->route('dashboard');
        }
        //$user=User::find($id);
        $lector->delete();
        return redirect()->route('users.index');
    }
}
