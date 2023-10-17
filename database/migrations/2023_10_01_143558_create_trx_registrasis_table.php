<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrxRegistrasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trx_registrasis', function (Blueprint $table) {
            $table->increments('id_registrasi');
            $table->integer('id_pasien');
            $table->integer('no_registrasi');
            $table->string('jenis_registrasi');
            $table->string('jenis_pembayaran');
            $table->string('status_registrasi');
            $table->integer('id_layanan');
            $table->date('waktu_mulai_layanan');
            $table->date('waktu_selesai_layanan');
            $table->integer('id_petugas');
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
        Schema::dropIfExists('trx_registrasis');
    }
}
