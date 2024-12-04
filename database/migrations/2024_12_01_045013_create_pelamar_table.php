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
        Schema::create('pelamar', function (Blueprint $table) {
            $table->integer('idpelamar', true);
            $table->integer('idpengguna');
            $table->integer('idloker');
            $table->string('namalengkap', 250);
            $table->string('email');
            $table->string('nohp');
            $table->text('file');
            $table->text('keterangan')->nullable();
            $table->string('status');
            $table->date('tanggal');
            $table->text('catatan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelamar');
    }
};
