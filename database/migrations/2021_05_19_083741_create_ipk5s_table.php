<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIpk5sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ipk5s', function (Blueprint $table) {
            $table->integer('ipk5_id')->autoIncrement();
            $table->string('job_position_id', 5);
            $table->string('ipk5_month', 8);
            $table->integer('town_id');
            $table->integer('rest_last_month_l')->default(0);
            $table->integer('registered_this_month_l')->default(0);
            $table->integer('placement_this_month_l')->default(0);
            $table->integer('deleted_this_month_l')->default(0);
            $table->integer('rest_this_month_l')->default(0);
            $table->integer('rest_last_month_p')->default(0);
            $table->integer('registered_this_month_p')->default(0);
            $table->integer('placement_this_month_p')->default(0);
            $table->integer('deleted_this_month_p')->default(0);
            $table->integer('rest_this_month_p')->default(0);
            $table->timestamps();

            $table->foreign('job_position_id')->references('job_position_id')->on('job_positions')
            ->onUpdate('restrict')
            ->onDelete('restrict');
            $table->foreign('town_id')->references('town_id')->on('towns')
            ->onUpdate('restrict')
            ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ipk5s');
    }
}
