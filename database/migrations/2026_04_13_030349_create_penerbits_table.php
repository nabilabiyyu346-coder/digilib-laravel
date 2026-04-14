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
        Schema::create('penerbits', function (Blueprint $table) {
            $table->unsignedInteger('kodePenerbit')->primary()->autoIncrement();
            $table->string('nama', 100);
            $table->text('alamat');
            $table->string('telp', 18);
            $table->string('email', 50);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penerbits');
    }
};
