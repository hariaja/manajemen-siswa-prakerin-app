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
    Schema::create('attendances', function (Blueprint $table) {
      $table->id();
      $table->string('uuid');
      $table->foreignId('study_program_id')->constrained('study_programs')->onDelete('cascade');
      $table->string('title')->unique();
      $table->string('description')->nullable();
      $table->time('start_time'); // mulai absen masuk
      $table->time('timeout_start_time'); // akhir absen masuk
      $table->time('end_time'); // mulai absen pulang
      $table->time('timeout_end_time'); // akhir absen pulang
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('attendances');
  }
};
