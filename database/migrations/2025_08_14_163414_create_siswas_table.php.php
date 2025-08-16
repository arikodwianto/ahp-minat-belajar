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
    Schema::create('siswas', function (Blueprint $table) {
    $table->id();
    $table->string('nama');
    $table->string('nis')->unique();
    $table->string('jenis_kelamin');
    $table->date('tanggal_lahir');
    $table->string('tempat_lahir');
    $table->string('agama');
    $table->string('alamat');
    $table->string('telepon')->nullable();
    $table->string('email')->nullable();
    $table->foreignId('kelas_id')->constrained('kelas')->onDelete('cascade');
    $table->string('tahun_masuk')->nullable();
    $table->string('sekolah_asal')->nullable();
    $table->timestamps();
});

}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
