<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Kaduan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kaduan', function (Blueprint $table) {

            $table->id();
            $table->string('tiket');
            $table->string('keterangan');
            $table->string('foto');
            $table->string('kecamatan');
            $table->string('kelurahan');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('username');
            $table->string('device_id');
            $table->string('status');
            $table->string('petugas');
            $table->string('tglwaktu');
            $table->rememberToken();
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
        //
    }
}
