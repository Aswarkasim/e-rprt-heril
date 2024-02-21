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
        Schema::create('peringkats', function (Blueprint $table) {
            $table->id();

            $table->string('nisn');
            $table->foreignId('kelas_id');
            $table->foreignId('ta_id');
            $table->integer('semester');
            $table->integer('peringkat');
            $table->text('pesan');
            $table->float('rerata_nilai')->default(0);

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
        Schema::dropIfExists('peringkats');
    }
};
