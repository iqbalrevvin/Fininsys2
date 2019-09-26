<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrakerinPenempatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prakerin_penempatan', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('prakerin_master_id');
            $table->unsignedBigInteger('prakerin_instansi');
            $table->unsignedInteger('prakerin_pembimbing_lapangan_id');
            $table->unsignedInteger('tenpen_id');
            $table->date('tgl_mulai');
            $table->date('tgl_selesai');
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
        Schema::dropIfExists('prakerin_penempatan');
    }
}
