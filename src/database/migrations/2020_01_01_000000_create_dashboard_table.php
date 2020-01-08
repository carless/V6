<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDashboardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('core_dashboard', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 250);

            $table->unsignedInteger('created_by')->nullable()->default(null);
            $table->unsignedInteger('updated_by')->nullable()->default(null);
            $table->timestamps();
        });

        Schema::create('core_dashboard_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('dashboard_id')->nullable();
            $table->string('name', 250)->nullable();
            $table->string('area', 250)->nullable();
            $table->string('tipo', 50)->nullable();
            $table->integer('sorting')->nullable();
            $table->longtext('config')->nullable();

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
        Schema::dropIfExists('core_dashboard');
        Schema::dropIfExists('core_dashboard_items');
    }
}