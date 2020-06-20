<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataTGASTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_tga', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('user_id')->nullable()->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');

            $table->enum('category', ['data_usul_tga', 'data_administrasi_tga', 'data_seminar', 'data_sidang', 'data_yudisium']);
            $table->enum('type', ['inline', 'file']);
            $table->string('name')->unique();
            $table->string('display_name')->nullable();
            $table->string('content');
            $table->boolean('temporary')->default(false);
            $table->boolean('verified')->default(false);

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
        Schema::dropIfExists('data_tga');
    }
}
