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
        Schema::table('bukus', function (Blueprint $table) {
            // Make optional fields nullable
            $table->string('issn_isbn', 30)->nullable()->change();
            $table->string('seri', 10)->nullable()->change();
            $table->text('abstraksi')->nullable()->change();
            $table->text('image')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bukus', function (Blueprint $table) {
            $table->string('issn_isbn', 30)->nullable(false)->change();
            $table->string('seri', 10)->nullable(false)->change();
            $table->text('abstraksi')->nullable(false)->change();
            $table->text('image')->nullable(false)->change();
        });
    }
};
