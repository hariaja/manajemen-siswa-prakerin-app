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
    Schema::create('presences', function (Blueprint $table) {
      $table->id();
      $table->foreignId('student_id')->constrained()->onDelete('cascade');
      $table->foreignId('attendance_id')->constrained()->onDelete('cascade');
      $table->string('uuid');
      $table->date('presence_date');
      $table->time('presence_enter_time')->nullable();
      $table->time('presence_out_time')->nullable();
      $table->boolean('is_permission')->default(0);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('presences');
  }
};
