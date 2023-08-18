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
        Schema::create('gurus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kelas_id')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->string('nip')->nullable();
            $table->string('name');
            $table->string('agama')->nullable();
            $table->string('alamat')->nullable();
            $table->string('nohp')->nullable();
            $table->text('foto')->nullable();
            $table->enum('jabatan', ['Kepala Sekolah', 'Guru'])->nullable();
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
        Schema::dropIfExists('gurus');
    }
};
