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
    Schema::create('admins', function (Blueprint $table) {
        $table->id();
        $table->boolean('perfil')->default(0); // 0 para admin
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
        Schema::dropIfExists('admins');
    }
};

