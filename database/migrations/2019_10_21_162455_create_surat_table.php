<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuratTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('surat_indeks_id');
            $table->string('nomor');
            $table->string('lampiran');
            $table->string('prihal');
            $table->date('tanggal');
            $table->string('tujuan_surat');
            $table->longText('isi');
            $table->mediumText('tanda_tangan');
            $table->string('tembusan');
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
        Schema::dropIfExists('surat');
    }
}
