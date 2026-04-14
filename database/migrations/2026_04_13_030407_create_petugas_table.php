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
        Schema::create('petugas', function (Blueprint $table) {
            $table->unsignedInteger('kodePetugas')->primary()->autoIncrement();
            $table->string('username', 40)->unique();
            $table->string('password', 255);
            $table->string('nama', 200);
            $table->text('email');
            $table->dateTime('dateInput');
            $table->dateTime('dateUpdate');
            $table->string('tempatLahir', 40);
            $table->date('tanggalLahir');
            $table->text('alamat');
            $table->text('image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('petugas');
    }
};
