<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFuaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fuas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fua_NumFormato',20)->unique();
            $table->integer('id_afiliado');  
            $table->integer('fua_Personal');
            $table->integer('fua_Lugar');
            $table->string('fua_LugarDesc')->nullable();
            $table->integer('fua_Atencion');
            $table->date('fua_fechaAtencion');
            $table->integer('fua_ConceptoPrestacional');
            $table->integer('fua_DestinoAsegurado');
            $table->float('fua_peso',8,2)->nullable();
            $table->float('fua_talla',8,2)->nullable();
            $table->float('fua_imc',8,2)->nullable();
            $table->integer('fua_profesional')->nullable();
            $table->tinyInteger('estado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fuas');
    }
}
