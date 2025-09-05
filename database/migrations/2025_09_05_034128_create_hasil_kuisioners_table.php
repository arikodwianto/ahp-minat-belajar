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
       Schema::create('hasil_kuisioners', function (Blueprint $table) {
    $table->id();
    $table->foreignId('siswa_id')->constrained()->onDelete('cascade');
    $table->foreignId('pertanyaan_id')->constrained()->onDelete('cascade');
    $table->foreignId('jawaban_id')->constrained()->onDelete('cascade');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_kuisioners');
    }
};
