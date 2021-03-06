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
            $table->string('name');
            $table->string('address');
            $table->date('date_of_birth')->format('m-d-Y');
            $table->enum('role', ['admin', 'user'])->default('user');
            $table->string('email')->unique();
            $table->enum('gender', ['laki-laki', 'perempuan'])->default('laki-laki');
            $table->foreignId('instrument_saham_id');
            $table->float('w_eps_kon');
            $table->float('w_roe_kon');
            $table->float('w_per_kon');
            $table->float('w_der_kon');
            $table->float('w_eps_syar');
            $table->float('w_roe_syar');
            $table->float('w_per_syar');
            $table->float('w_der_syar');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
