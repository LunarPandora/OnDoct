<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingAppointmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_appointment', function (Blueprint $table) {
            $table->id('id_appointment')->autoIncrement();
            $table->integer('antrian');
            $table->integer('id_dokter');
            $table->integer('id_pasien');
            $table->dateTime('waktu_appointment');
            $table->string('status_appointment', 15);
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
        Schema::dropIfExists('booking_appointment');
    }
}
