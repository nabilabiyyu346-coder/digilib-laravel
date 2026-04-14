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
        Schema::table('pinjams', function (Blueprint $table) {
            // Change kodePeminjam to BIGINT to handle larger values
            $table->unsignedBigInteger('kodePeminjam')->change();
            // Change kodePetugas to BIGINT for consistency
            $table->unsignedBigInteger('kodePetugas')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pinjams', function (Blueprint $table) {
            $table->unsignedInteger('kodePeminjam')->change();
            $table->unsignedInteger('kodePetugas')->change();
        });
    }
};
