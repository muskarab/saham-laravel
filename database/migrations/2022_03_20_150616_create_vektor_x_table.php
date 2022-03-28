<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVektorXTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vektor_x', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('emiten_id');
            $table->double('sim_der_kon');
            $table->double('sim_per_kon');
            $table->double('sim_roe_kon');
            $table->double('sim_eps_kon');
            $table->double('sim_der_syar');
            $table->double('sim_per_syar');
            $table->double('sim_roe_syar');
            $table->double('sim_eps_syar');
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
        Schema::dropIfExists('vektor_x');
    }
}
