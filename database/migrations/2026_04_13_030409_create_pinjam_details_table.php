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
        Schema::create('pinjam_details', function (Blueprint $table) {
            $table->unsignedInteger('kodePinjamDetail')->primary()->autoIncrement();
            $table->unsignedBigInteger('kodePinjam');
            $table->unsignedInteger('kodeBuku');
            $table->foreign('kodePinjam')->references('kodePinjam')->on('pinjams')->onDelete('cascade');
            $table->foreign('kodeBuku')->references('kodeBuku')->on('bukus')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pinjam_details');
    }
};
