<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Netizen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('netizens', function (Blueprint $table) {

            $table->id();
            $table->string('nama');
            $table->string('alamat');
            $table->string('profesi');
            $table->string('jk');
            $table->string('foto');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('device_id');
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
