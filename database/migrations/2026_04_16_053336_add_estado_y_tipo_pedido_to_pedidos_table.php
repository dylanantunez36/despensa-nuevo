<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {   
        Schema::table('pedidos', function (Blueprint $table) {
            $table->string('estado')->default('pendiente'); // pendiente / procesado
            $table->string('tipo_entrega')->default('domicilio'); // domicilio / recoger
        });
    }

public function down()
    {
        Schema::table('pedidos', function (Blueprint $table) {
            $table->dropColumn(['estado', 'tipo_entrega']);
        });
    }
};
