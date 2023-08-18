<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->string('nisn');
            $table->string('nis')->nullable();
            $table->foreignId('kelas_id')->nullable();
            $table->foreignId('ta_id')->nullable();
            $table->string('name');
            $table->string('agama')->nullable();
            $table->string('gender')->nullable();
            $table->text('foto')->nullable();
            $table->string('alamat')->nullable();
            $table->string('nohp')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
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
        Schema::dropIfExists('siswas');
    }
};
