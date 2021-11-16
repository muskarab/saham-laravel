<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreferensiKriteriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preferensi_kriterias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('emiten_id')->unique();
            $table->double('eps_pk');
            $table->double('roe_pk');
            $table->double('per_pk');
            $table->double('der_pk');
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
        Schema::dropIfExists('preferensi_kriterias');
    }
}
