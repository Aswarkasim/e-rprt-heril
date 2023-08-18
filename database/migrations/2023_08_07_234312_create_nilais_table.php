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
        Schema::create('nilais', function (Blueprint $table) {
            $table->id();
            $table->string('nisn');
            $table->foreignId('kelas_id');
            $table->foreignId('mapel_id');
            $table->foreignId('ta_id');
            $table->integer('semester');
            $table->float('af_tp1')->default(0);
            $table->float('af_tp2')->default(0);
            $table->float('as_tes')->default(0);
            $table->float('as_nontes')->default(0);
            $table->float('nilai')->default(0);
            $table->text('desc_1')->nullable();
            $table->text('desc_2')->nullable();
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
        Schema::dropIfExists('nilais');
    }
};
