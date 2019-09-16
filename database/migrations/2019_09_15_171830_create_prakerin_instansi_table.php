<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrakerinInstansiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prakerin_instansi', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->unsignedBigInteger('prakerin_bidang_usaha_id');
            $table->string('alamat')->nullable();
            $table->string('rt')->nullable();
            $table->string('rw')->nullable();
            $table->string('kelurahan_id')->nullable();
            $table->string('kecamatan_id')->nullable();
            $table->string('kabupaten_id')->nullable();
            $table->string('provinsi_id')->nullable();
            $table->string('kode_pos')->nullable();
            $table->string('no_telp')->nullable();
            $table->string('email')->nullable();
            $table->string('web')->nullable();
            $table->string('npwp')->nullable();
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
        Schema::dropIfExists('prakerin_instansi');
    }
}
