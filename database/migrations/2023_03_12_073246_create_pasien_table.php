<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasienTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pasien', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('nama_pasien', 50);
            $table->string('no_telp_pasien', 15);
            $table->string('email_pasien', 50);
            $table->char('gender', 1);
            $table->text('alergi');
            $table->string('agama', 10);
            $table->text('alamat_pasien');
            $table->timestamps();

            // $table->primary('id_pasien');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pasien');
    }
}
