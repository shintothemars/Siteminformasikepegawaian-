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
        Schema::create('karyawans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('foto_profil')->nullable();
            $table->string('jabatan');
            $table->string('nama_panggilan')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('golongan_darah')->nullable();
            $table->string('agama')->nullable();
            $table->text('alamat')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('status')->nullable(); // Kawin, Belum Kawin, Duda/Janda
            $table->integer('jumlah_anak')->nullable();
            $table->integer('tinggi_badan')->nullable(); // dalam cm
            $table->integer('berat_badan')->nullable(); // dalam kg
            $table->string('no_ktp')->nullable();
            $table->date('ktp_berlaku_sampai')->nullable();
            $table->boolean('tinggal_dengan_keluarga')->default(false);
            $table->string('anak_ke')->nullable();
            $table->string('darurat_nama')->nullable();
            $table->string('darurat_hubungan')->nullable();
            $table->string('darurat_telepon')->nullable();
            $table->text('darurat_alamat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawans');
    }
};
