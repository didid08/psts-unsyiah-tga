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
            $table->enum('category', ['admin', 'pejabat', 'dosen', 'mahasiswa'])->nullable();
            $table->string('username')->unique()->nullable();
            $table->string('nomor_induk')->unique()->nullable();
            $table->string('nama');

            $table->integer('bidang_id')->nullable()->unsigned();
            $table->foreign('bidang_id')->references('id')->on('bidang')->onDelete('set null');

            $table->string('avatar')->unique()->nullable();

            $table->string('email')->nullable();
            $table->string('password');
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
