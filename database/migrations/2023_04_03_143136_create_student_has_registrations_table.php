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
    Schema::create('student_has_registrations', function (Blueprint $table) {
      $table->id();
      $table->foreignId('student_id')->constrained('students', 'id')->onDelete('cascade');
      $table->foreignId('registration_id')->constrained('registrations', 'id')->onDelete('cascade');
      $table->timestamp('duration_start_date')->nullable();
      $table->timestamp('duration_end_date')->nullable();
      $table->tinyInteger('status')->default(0);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('student_has_registrations');
  }
};
