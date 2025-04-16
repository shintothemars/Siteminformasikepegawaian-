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
        Schema::create('pengalaman_kerjas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('karyawan_id')->constrained()->onDelete('cascade');
            $table->string('nama_perusahaan');
            $table->string('jabatan');
            $table->string('mulai_bulan')->nullable();
            $table->string('mulai_tahun')->nullable();
            $table->string('sampai_bulan')->nullable();
            $table->string('sampai_tahun')->nullable();
            $table->string('gaji')->nullable();
            $table->text('alasan_keluar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengalaman_kerjas');
    }
};
