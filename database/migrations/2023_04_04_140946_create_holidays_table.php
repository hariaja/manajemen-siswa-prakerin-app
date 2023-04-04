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
    Schema::create('holidays', function (Blueprint $table) {
      $table->id();
      $table->string('uuid');
      $table->foreignId('study_program_id')->constrained('study_programs')->onDelete('cascade');
      $table->string('title')->unique();
      $table->date('holiday_date');
      $table->string('description')->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('holidays');
  }
};
