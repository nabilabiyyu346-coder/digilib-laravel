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
        Schema::create('bukus', function (Blueprint $table) {
            $table->unsignedInteger('kodeBuku')->primary()->autoIncrement();
            $table->text('judul');
            $table->unsignedInteger('kodePenerbit');
            $table->unsignedInteger('kodePengarang');
            $table->unsignedInteger('tahun');
            $table->string('edisi', 20);
            $table->string('issn_isbn', 30);
            $table->string('seri', 10);
            $table->text('abstraksi');
            $table->unsignedInteger('kodeKategori');
            $table->dateTime('tglInput');
            $table->dateTime('tglUpdate');
            $table->text('image');
            $table->unsignedInteger('lastUpdateBy');
            $table->foreign('kodePenerbit')->references('kodePenerbit')->on('penerbits')->onDelete('cascade');
            $table->foreign('kodePengarang')->references('kodePengarang')->on('pengarangs')->onDelete('cascade');
            $table->foreign('kodeKategori')->references('kodeKategori')->on('kategoris')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bukus');
    }
};
