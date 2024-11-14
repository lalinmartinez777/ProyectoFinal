<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('students', function (Blueprint $table) {
        $table->id();
        $table->boolean('perfil')->default(1); // 1 para alumno
        $table->string('clave', 4)->unique(); // ID de 4 dígitos
        $table->string('nombre');
        $table->string('correo')->unique();
        $table->string('contraseña');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
