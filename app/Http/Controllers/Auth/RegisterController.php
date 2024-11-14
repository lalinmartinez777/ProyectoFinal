<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'perfil' => 'required|in:0,1',
            'clave' => 'required|digits:4|unique:admins,clave|unique:students,clave',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins,correo|unique:students,correo',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Verificar si el perfil es admin o alumno y crear el registro correspondiente
        if ($request->perfil == 0) {
            Admin::create([
                'perfil' => $request->perfil,
                'clave' => $request->clave,
                'name' => $request->nombre,
                'email' => $request->correo,
                'contraseña' => Hash::make($request->password),
            ]);
            return Redirect::route('admin.welcome');
        } else {
            Student::create([
                'perfil' => $request->perfil,
                'clave' => $request->clave,
                'name' => $request->nombre,
                'email' => $request->correo,
                'contraseña' => Hash::make($request->password),
            ]);
            return Redirect::route('student.welcome');
        }
    }
}
