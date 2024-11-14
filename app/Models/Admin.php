<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $fillable = ['perfil', 'clave', 'nombre', 'correo', 'contraseña'];

    public function classes()
    {
        return $this->hasMany(ClassModel::class);
    }
}