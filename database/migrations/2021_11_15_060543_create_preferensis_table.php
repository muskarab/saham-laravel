<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreferensisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preferensis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('index_id')->unique();
            $table->double('min_eps');
            $table->double('max_eps');
            $table->double('mean_eps');
            $table->double('avg_bawah_eps');
            $table->double('avg_atas_eps');
            $table->double('min_roe');
            $table->double('max_roe');
            $table->double('mean_roe');
            $table->double('avg_bawah_roe');
            $table->double('avg_atas_roe');
            $table->double('min_per');
            $table->double('max_per');
            $table->double('mean_per');
            $table->double('avg_bawah_per');
            $table->double('avg_atas_per');
            $table->double('min_der');
            $table->double('max_der');
            $table->double('mean_der');
            $table->double('avg_bawah_der');
            $table->double('avg_atas_der');
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
        Schema::dropIfExists('preferensis');
    }
}
