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
            $table->string('descripsi');
            $table->float('der', 8, 2);
            $table->float('per', 8, 2);
            $table->float('roe', 8, 2);
            $table->float('eps', 8, 2);
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
