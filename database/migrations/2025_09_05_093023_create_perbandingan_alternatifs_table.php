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
        Schema::create('perbandingan_alternatifs', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('siswa_id'); 
    $table->unsignedBigInteger('kriteria_id'); 
    $table->unsignedBigInteger('alternatif1_id');
    $table->unsignedBigInteger('alternatif2_id');
    $table->unsignedBigInteger('pilihan'); // id alternatif yang dipilih
    $table->integer('nilai'); // skala 1-9
    $table->text('alasan')->nullable();
    $table->timestamps();

    $table->foreign('siswa_id')->references('id')->on('siswas')->onDelete('cascade');
    $table->foreign('kriteria_id')->references('id')->on('kriterias')->onDelete('cascade');
    $table->foreign('alternatif1_id')->references('id')->on('alternatifs')->onDelete('cascade');
    $table->foreign('alternatif2_id')->references('id')->on('alternatifs')->onDelete('cascade');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perbandingan_alternatifs');
    }
};
