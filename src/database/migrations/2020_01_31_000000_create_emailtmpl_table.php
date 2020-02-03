<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailTmplTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('core_email_tmpl', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->string('slug', 255)->nullable();
            $table->string('theme', 255)->nullable();
            $table->string('subject', 255)->nullable();
            $table->longtext('content')->nullable();
            $table->string('from_name', 255)->nullable();
            $table->string('from_email', 255)->nullable();
            $table->string('cc_email', 255)->nullable();

            $table->unsignedInteger('created_by')->nullable()->default(null);
            $table->unsignedInteger('updated_by')->nullable()->default(null);

            $table->timestamps();
        });

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
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('core_email_tmpl');
    }
}
