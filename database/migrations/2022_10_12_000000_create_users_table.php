<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('nip')->unique();
            $table->string('username')->unique();
            $table->string('name');
            $table->string('password');
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('photo')->nullable();
            $table->string('role');
            $table->integer('office_id');
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('office_id')->references('office_id')->on('offices')
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
        Schema::dropIfExists('users');
    }
}
