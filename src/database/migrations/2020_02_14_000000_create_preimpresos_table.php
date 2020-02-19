<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreimpresosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('core_preimpresos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug', 255)->nullable();
            $table->string('name', 255);
            $table->string('archivo', 255)->nullable();
            $table->unsignedInteger('tipo')->nullable()->default(null);

            $table->string('papel', 5)->default('A4');
            $table->string('orientacion', 1)->default('P');
            $table->integer('margenCab')->default('0');
            $table->integer('margenPie')->default('0');
            $table->integer('margenIzq')->default('0');
            $table->integer('margenDer')->default('0');
            $table->tinyInteger('mostrarCab')->default('1');
            $table->tinyInteger('mostrarLogo')->default('1');
            $table->tinyInteger('mostrarTitulo')->default('1');
            $table->tinyInteger('mostrarSubtitulo')->default('1');
            $table->tinyInteger('mostrarPie')->default('1');
            $table->integer('tituloPosX')->default('0');
            $table->integer('tituloPosY')->default('0');
            $table->integer('logoPosX')->default('0');
            $table->integer('logoPosY')->default('0');
            $table->integer('pieSeparador')->default('1');
            $table->tinyInteger('pieFecha')->default('1');
            $table->tinyInteger('pieHora')->default('1');
            $table->tinyInteger('pieNumPag')->default('1');
            $table->tinyInteger('pieNumParte')->default('1');
            $table->longtext('observaciones')->nullable();
            $table->tinyInteger('activo')->default(1);

            $table->unsignedInteger('created_by')->nullable()->default(null);
            $table->unsignedInteger('updated_by')->nullable()->default(null);

            $table->timestamps();
        });

        /*
        DB::table('core_email_tmpl')->insert(
            array(
                'id'            => 1,
                'name'          => 'Default Email',
                'slug'          => 'default_template',
                'theme'         => 'cesi::core.mail.standart.mailtemplate',
                'content'       => '<p>Hola [username],</p><p>Bienvenido a nuestro portal! Muchas gracias por unirse a nosotros.</p>',
                'from_name'     => 'System',
                'from_email'    => 'system@cesigrup.com',
                'cc_email'      => NULL
            )
        );
        */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('core_preimpresos');
    }
}
