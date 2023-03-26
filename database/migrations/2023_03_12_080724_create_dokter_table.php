<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDokterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dokter', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('nama_dokter', 50);
            $table->string('jenis_spesialis', 30);
            $table->string('no_telp_dokter', 15);
            $table->string('email_dokter', 50);
            $table->text('alamat_dokter');
            $table->char('gender', 1);
            $table->text('foto_surat_praktek');
            $table->timestamps();

            // $table->primary('id_dokter');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dokter');
    }
}
