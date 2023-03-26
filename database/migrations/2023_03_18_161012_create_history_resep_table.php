<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryResepTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_resep', function (Blueprint $table) {
            $table->id('id_resep')->autoIncrement();
            $table->text('foto_resep');
            $table->integer('id_dokter');
            $table->integer('id_pasien');
            $table->integer('id_farmasi');
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
        Schema::dropIfExists('history_resep');
    }
}
