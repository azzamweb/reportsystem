<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('jenis_laporans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_laporan');
            $table->text('keterangan')->nullable();
            $table->string('gambar')->nullable();
            $table->timestamps();
        });

        
    }

    public function down()
    {
        Schema::table('laporans', function (Blueprint $table) {
            $table->dropForeign(['jenis_laporan_id']);
            $table->dropColumn('jenis_laporan_id');
        });
        Schema::dropIfExists('jenis_laporan');
    }
};
