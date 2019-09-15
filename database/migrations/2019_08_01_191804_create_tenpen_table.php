<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTenpenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenpen', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nik',16);
            $table->string('nuptk',16)->nullabel();
            $table->string('nip',16)->nullabel();
            $table->string('niy_nigk')->nullabel();
            $table->date('tmt');
            $table->date('tst')->nullabel();
            $table->string('nama_lengkap',16);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('agama',25);
            $table->integer('pendidikan_id');
            $table->string('kewarganegaraan',3);
            $table->string('provinsi_id');
            $table->string('kabupaten_id');
            $table->string('kecamatan_id');
            $table->string('kelurahan_id');
            $table->string('rt',2)->nullabel();
            $table->string('rw',2)->nullabel();
            $table->string('no_telp');
            $table->string('email')->nullabel();
            $table->string('foto')->nullabel();
            $table->string('nama_ayah')->nullabel();
            $table->string('tahun_lahir_ayah',4)->nullabel();
            $table->string('nama_ibu')->nullabel();
            $table->string('tahun_lahir_ibu',4)->nullabel();
            $table->string('facebook')->nullabel();
            $table->string('instagram')->nullabel();
            $table->string('twitter')->nullabel();
            $table->string('lampiran_1')->nullabel();
            $table->string('lampiran_2')->nullabel();
            $table->string('lampiran_3')->nullabel();
            $table->string('lampiran_4')->nullabel();
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
        Schema::dropIfExists('tenpen');
    }
}
