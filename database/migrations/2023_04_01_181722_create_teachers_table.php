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
    Schema::create('teachers', function (Blueprint $table) {
      $table->id();
      $table->foreignId('user_id')->constrained('users', 'id')->onDelete('cascade');
      $table->foreignId('school_id')->nullable()->constrained('schools', 'id')->onDelete('cascade');
      $table->string('uuid');
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
    Schema::dropIfExists('teachers');
  }
};
