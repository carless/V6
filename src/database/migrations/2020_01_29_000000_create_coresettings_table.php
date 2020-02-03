<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoreSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('core_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('key', 255);                         // Codigo de la configuración
            $table->string('description', 255)->nullable();     // Descripcion
            $table->longtext('value')->nullable();              // Valor
            $table->string('field', 255)->nullable();           // sub-tipo, por lo general string
            $table->longtext('fieldcfg')->nullable();           // json con la configuración del field

            $table->unsignedInteger('created_by')->nullable()->default(null);
            $table->unsignedInteger('updated_by')->nullable()->default(null);

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
        Schema::dropIfExists('core_settings');
    }
}