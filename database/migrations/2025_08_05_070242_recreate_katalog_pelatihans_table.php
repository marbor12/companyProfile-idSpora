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
        // Drop table lama dan buat ulang dengan struktur baru
        Schema::dropIfExists('katalog_pelatihans');
        
        Schema::create('katalog_pelatihans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pelatihan');
            $table->text('deskripsi')->nullable();
            $table->string('kategori'); // berbayar, free, khusus
            $table->decimal('harga', 10, 2)->nullable();
            $table->string('instructor')->nullable();
            $table->date('tanggal_pelatihan')->nullable();
            $table->text('materi')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('katalog_pelatihans');
        
        // Restore original table structure
        Schema::create('katalog_pelatihans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pelatihan');
            $table->text('deskripsi')->nullable();
            $table->string('kategori')->nullable();
            $table->integer('durasi_jam')->nullable();
            $table->decimal('harga', 10, 2)->nullable();
            $table->string('instructor')->nullable();
            $table->string('level')->nullable();
            $table->text('materi')->nullable();
            $table->string('sertifikat')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }
};
