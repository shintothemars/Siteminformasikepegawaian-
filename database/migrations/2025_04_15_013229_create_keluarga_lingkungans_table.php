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
        Schema::create('keluarga_lingkungans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('karyawan_id')->constrained()->onDelete('cascade');
            $table->string('hubungan');
            $table->string('nama');
            $table->string('jenis_kelamin')->nullable();
            $table->string('umur')->nullable();
            $table->string('pendidikan')->nullable();
            $table->text('alamat')->nullable();
            $table->string('profesi')->nullable();
            $table->string('telepon')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keluarga_lingkungans');
    }
};
