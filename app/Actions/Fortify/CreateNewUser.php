<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\Student;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        // Validar los datos
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'perfil' => ['required', 'in:0,1'], // 0 para Admin, 1 para Student
            'clave' => ['required', 'string', 'size:4', 'unique:students,clave', 'unique:admins,clave'],
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        // Crear registro en la tabla `users`
        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);

        // Determinar el perfil y guardar en la tabla correspondiente
        if ((int) $input['perfil'] === 1) { // Si es estudiante
            Student::create([
                'user_id' => $user->id, // Relacionar con la tabla `users`
                'perfil' => 1,
                'clave' => $input['clave'],
                'nombre' => $input['name'],
                'correo' => $input['email'],
                'contraseña' => Hash::make($input['password']),
            ]);
        } else if ((int) $input['perfil'] === 0) { // Si es administrador
            Admin::create([
                'user_id' => $user->id, // Relacionar con la tabla `users`
                'perfil' => 0,
                'clave' => $input['clave'],
                'nombre' => $input['name'],
                'correo' => $input['email'],
                'contraseña' => Hash::make($input['password']),
            ]);
        }

        return $user;
    }
}
