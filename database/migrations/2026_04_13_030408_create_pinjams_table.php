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
        Schema::create('pinjams', function (Blueprint $table) {
            $table->unsignedBigInteger('kodePinjam')->primary();
            $table->unsignedInteger('kodePetugas');
            $table->unsignedInteger('kodePeminjam');
            $table->unsignedTinyInteger('tipePeminjam'); // 1=dosen, 2=mahasiswa, 3=petugas
            $table->dateTime('tglPinjam');
            $table->dateTime('tglKembali')->nullable();
            $table->text('keterangan')->nullable();
            $table->tinyInteger('status'); // 1=aktif, 2=selesai
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pinjams');
    }
};
