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
        Schema::table('katalog_pelatihans', function (Blueprint $table) {
            // Rename kategori to tipe_pelatihan  
            $table->renameColumn('kategori', 'tipe_pelatihan');
            
            // Add kategori field for course category
            $table->string('kategori_materi')->nullable()->after('tipe_pelatihan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('katalog_pelatihans', function (Blueprint $table) {
            $table->renameColumn('tipe_pelatihan', 'kategori');
            $table->dropColumn('kategori_materi');
        });
    }
};
