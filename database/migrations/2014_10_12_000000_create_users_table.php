<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ta_id_active')->nullable();
            $table->string('username')->unique();
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('role', ['admin', 'guru']);

            $table->foreignId('kelas_id')->nullable();
            $table->string('nip')->nullable();
            $table->string('agama')->nullable();
            $table->string('alamat')->nullable();
            $table->string('nohp')->nullable();
            $table->text('foto')->nullable();
            $table->enum('jabatan', ['Kepala Sekolah', 'Guru'])->nullable();


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
        Schema::dropIfExists('users');
    }
}
