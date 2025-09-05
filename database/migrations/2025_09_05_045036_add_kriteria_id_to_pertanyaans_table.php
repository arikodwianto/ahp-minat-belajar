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
    Schema::table('pertanyaans', function (Blueprint $table) {
        $table->foreignId('kriteria_id')->constrained('kriterias')->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('pertanyaans', function (Blueprint $table) {
        $table->dropForeign(['kriteria_id']);
        $table->dropColumn('kriteria_id');
    });
}

};
