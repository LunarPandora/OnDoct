<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryAppointmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_appointment', function (Blueprint $table) {
            $table->id('id_appointment')->autoIncrement();
            $table->integer('id_dokter');
            $table->integer('id_farmasi');
            $table->integer('id_pasien');
            $table->integer('id_history_resep')->nullable();
            $table->string('status', 20);
            $table->text('riwayat');
            $table->dateTime('waktu');
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
        Schema::dropIfExists('history_appointment');
    }
}
