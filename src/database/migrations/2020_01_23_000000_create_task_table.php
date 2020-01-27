<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('core_taskstatus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);                        // Titulo
            $table->string('classname', 255);                   // CSS Class

            $table->unsignedInteger('created_by')->nullable()->default(null);
            $table->unsignedInteger('updated_by')->nullable()->default(null);
            $table->timestamps();
        });

        DB::table('core_taskstatus')->insert(
            array(
                'id'        => 1,
                'name'      => 'Pendiente',
                'classname' => 'label label-warning'
            )
        );

        DB::table('core_taskstatus')->insert(
            array(
                'id'        => 2,
                'name'      => 'Finalizado',
                'classname' => 'label label-success'
            )
        );

        DB::table('core_taskstatus')->insert(
            array(
                'id'        => 3,
                'name'      => 'En proceso',
                'classname' => 'label label-info'
            )
        );

        DB::table('core_taskstatus')->insert(
            array(
                'id'        => 4,
                'name'      => 'Rechazada',
                'classname' => 'label label-danger'
            )
        );

        DB::table('core_taskstatus')->insert(
            array(
                'id'        => 5,
                'name'      => 'Cancelada',
                'classname' => 'label label-danger'
            )
        );

        Schema::create('core_taskmanager', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);                        // Titulo
            $table->longText('description')->nullable();              // Descripcion
            $table->unsignedInteger('user_id')->nullable()->default(null);
            $table->unsignedInteger('status_id')->nullable()->default('1');
            $table->unsignedInteger('prioridad')->nullable()->default('0');
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_final')->nullable();
            $table->decimal('progreso', 6, 2)->nullable()->default('0.00');

            $table->longText('notas')->nullable();     // Notas

            $table->unsignedInteger('isptarea_id')->nullable();
            $table->unsignedInteger('servicio_id')->nullable();
            $table->unsignedInteger('csitasid')->nullable()->default(null);

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
        Schema::dropIfExists('core_taskstatus');
        Schema::dropIfExists('core_taskmanager');
    }
}
