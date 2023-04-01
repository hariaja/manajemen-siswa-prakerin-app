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
    Schema::create('schools', function (Blueprint $table) {
      $table->id();
      $table->string('uuid');
      $table->string('npsn')->unique();
      $table->string('name')->unique();
      $table->string('education');
      $table->enum('status', [Constant::NEGERI, Constant::SWASTA]);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('schools');
  }
};
