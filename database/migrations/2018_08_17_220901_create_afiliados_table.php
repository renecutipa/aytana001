<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAfiliadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('afiliados', function (Blueprint $table) {
            $table->increments('id');
            $table->string('afi_depa',20);
            $table->string('afi_prov',20);
            $table->string('afi_dist',20);
            $table->char('pre_CodEjeAdm',4);
            $table->char('afi_IdEESSAte',10);
            $table->string('pre_Nombre',20);
            $table->char('afi_IdDisa',3);
            $table->char('afi_IdDistrito',6);
            $table->char('afi_TipoFormato',1);
            $table->char('afi_NroFormato',8);
            $table->tinyInteger('afi_IdTipoDocumento');
            $table->char('afi_Dni',8)->nullable();
            $table->date('afi_FecFormato');
            $table->string('afi_ApePaterno',30);
            $table->string('afi_ApeMaterno',30);
            $table->string('afi_Nombres',30);
            $table->string('afi_SegNombre',40)->nullable();
            $table->char('afi_IdSexo',1);
            $table->date('afi_FecNac');
            $table->date('fechaActual');
            $table->integer('edad');
            $table->tinyInteger('afi_IdEstado');
            $table->date('afi_FecBaja')->nullable();
            $table->tinyInteger('clasificacion')->default('1');
            $table->string('historia',20)->nullable();
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
        Schema::dropIfExists('afiliados');
    }
}
