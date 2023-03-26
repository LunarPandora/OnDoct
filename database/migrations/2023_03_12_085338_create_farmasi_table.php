<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFarmasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farmasi', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('nama_farmasi', 50);
            $table->string('no_telp_farmasi', 15);
            $table->string('email_farmasi', 50);
            $table->text('alamat_farmasi');
            $table->text('foto_izin');
            $table->timestamps();

            // $table->primary('id_farmasi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('farmasi');
    }
}
