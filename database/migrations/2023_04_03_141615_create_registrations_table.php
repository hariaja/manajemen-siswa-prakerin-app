<?php

use App\Helpers\Global\Constant;
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
    Schema::create('registrations', function (Blueprint $table) {
      $table->id();
      $table->string('uuid');
      $table->foreignId('teacher_id')->constrained('teachers')->onDelete('cascade');
      $table->foreignId('schedule_id')->constrained('schedules')->onDelete('cascade');
      $table->string('code')->unique();
      $table->string('note');
      $table->date('register_date');
      $table->string('status')->default(Constant::APPROVED);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('registrations');
  }
};
