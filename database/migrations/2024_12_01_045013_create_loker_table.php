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
        Schema::create('loker', function (Blueprint $table) {
            $table->integer('idloker', true);
            $table->integer('idkategori')->index('idkategori');
            $table->integer('idemployer');
            $table->string('namapekerjaan', 250);
            $table->text('lokasi');
            $table->string('tipe');
            $table->string('kontak');
            $table->text('deskripsi')->default('0');
            $table->string('rentanggajiawal')->nullable();
            $table->string('rentanggajiakhir', 250);
            $table->date('tanggal')->useCurrent();
            $table->text('foto');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loker');
    }
};
