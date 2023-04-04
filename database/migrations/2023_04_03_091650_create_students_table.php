<?php

use App\Helpers\Global\Constant;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('students', function (Blueprint $table) {
      $table->id();
      $table->string('uuid');
      $table->foreignId('user_id')->constrained('users', 'id')->onDelete('cascade');
      $table->foreignId('school_id')->constrained('schools', 'id')->onDelete('cascade');
      $table->string('nisn')->unique();
      $table->date('date_birth');
      $table->string('major');
      $table->enum('gender', [Constant::MALE, Constant::FEMALE]);
      $table->longText('address');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('students');
  }
};
