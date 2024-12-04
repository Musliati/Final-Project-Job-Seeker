<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pengguna', function (Blueprint $table) {
            $table->integer('id', true);
            $table->text('nama');
            $table->text('email');
            $table->text('password');
            $table->text('telepon');
            $table->text('alamat')->nullable();
            $table->text('fotoprofil');
            $table->text('level');
            $table->date('tgl_lahir')->nullable();
            $table->string('tempat_lahir', 100)->nullable();
            $table->string('jekel', 100)->nullable();
            $table->text('deskripsiketerampilan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengguna');
    }
};
