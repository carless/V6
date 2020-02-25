<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('core_notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('message', 255);
            $table->unsignedInteger('user_id')->nullable();
            $table->boolean('tipo')->default(1)->comment('1 - Dashboard , 2 - Email , 3 - Both');
            $table->boolean('is_read')->default(0);

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
        Schema::dropIfExists('core_notifications');
    }
}
