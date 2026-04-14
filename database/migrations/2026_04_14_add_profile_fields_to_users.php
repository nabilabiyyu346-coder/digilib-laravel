<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        // Add fields to dosens table - tanpa uuid dulu
        Schema::table('dosens', function (Blueprint $table) {
            if (!Schema::hasColumn('dosens', 'gambar_profil')) {
                $table->string('gambar_profil')->nullable();
            }
            if (!Schema::hasColumn('dosens', 'alamat')) {
                $table->text('alamat')->nullable();
            }
        });

        // Add uuid column dan generate nilai
        if (!Schema::hasColumn('dosens', 'uuid')) {
            Schema::table('dosens', function (Blueprint $table) {
                $table->char('uuid', 36)->unique()->nullable();
            });
            
            // Update existing records dengan uuid
            $records = DB::table('dosens')->whereNull('uuid')->get();
            foreach ($records as $record) {
                DB::table('dosens')
                    ->where('kodeDosen', $record->kodeDosen)
                    ->update(['uuid' => (string) Str::uuid()]);
            }
        }

        // Add fields to mahasiswas table
        Schema::table('mahasiswas', function (Blueprint $table) {
            if (!Schema::hasColumn('mahasiswas', 'gambar_profil')) {
                $table->string('gambar_profil')->nullable();
            }
            if (!Schema::hasColumn('mahasiswas', 'alamat')) {
                $table->text('alamat')->nullable();
            }
        });

        // Add uuid column dan generate nilai
        if (!Schema::hasColumn('mahasiswas', 'uuid')) {
            Schema::table('mahasiswas', function (Blueprint $table) {
                $table->char('uuid', 36)->unique()->nullable();
            });
            
            // Update existing records dengan uuid
            $records = DB::table('mahasiswas')->whereNull('uuid')->get();
            foreach ($records as $record) {
                DB::table('mahasiswas')
                    ->where('kodeMhs', $record->kodeMhs)
                    ->update(['uuid' => (string) Str::uuid()]);
            }
        }

        // Add fields to petugas table
        Schema::table('petugas', function (Blueprint $table) {
            if (!Schema::hasColumn('petugas', 'gambar_profil')) {
                $table->string('gambar_profil')->nullable();
            }
            if (!Schema::hasColumn('petugas', 'alamat')) {
                $table->text('alamat')->nullable();
            }
        });

        // Add uuid column dan generate nilai
        if (!Schema::hasColumn('petugas', 'uuid')) {
            Schema::table('petugas', function (Blueprint $table) {
                $table->char('uuid', 36)->unique()->nullable();
            });
            
            // Update existing records dengan uuid
            $records = DB::table('petugas')->whereNull('uuid')->get();
            foreach ($records as $record) {
                DB::table('petugas')
                    ->where('kodePetugas', $record->kodePetugas)
                    ->update(['uuid' => (string) Str::uuid()]);
            }
        }
    }

    public function down(): void
    {
        Schema::table('dosens', function (Blueprint $table) {
            $table->dropColumn(['uuid', 'gambar_profil', 'alamat']);
        });

        Schema::table('mahasiswas', function (Blueprint $table) {
            $table->dropColumn(['uuid', 'gambar_profil', 'alamat']);
        });

        Schema::table('petugas', function (Blueprint $table) {
            $table->dropColumn(['uuid', 'gambar_profil', 'alamat']);
        });
    }
};


