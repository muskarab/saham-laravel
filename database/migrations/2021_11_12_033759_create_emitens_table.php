<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmitensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emitens', function (Blueprint $table) {
            $table->id();
            $table->char('emiten_char');
            $table->string('perusahaan');
            $table->foreignId('index_id');
            $table->foreignId('sektor_id');
            $table->string('deskripsi');
            $table->year('tahun');
            $table->double('der');
            $table->double('per');
            $table->double('roe');
            $table->double('eps');
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
        Schema::dropIfExists('emitens');
    }
}
