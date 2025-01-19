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
        Schema::create('tindak_lanjuts', function (Blueprint $table) {
            $table->id();
            $table->year('tahun_anggaran');
            $table->date('waktu_pengerjaan');
            $table->decimal('biaya', 15, 2);
            $table->foreignId('sumber_dana_id')->constrained('sumber_dana')->onDelete('cascade');
            $table->foreignId('laporan_id')->constrained('laporans')->onDelete('cascade');
            $table->string('foto')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('pihak_ketiga')->nullable();
            $table->string('dokumen_pendukung')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tindak_lanjuts');
    }
};
