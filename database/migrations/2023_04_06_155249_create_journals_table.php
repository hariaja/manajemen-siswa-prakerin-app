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
    Schema::create('journals', function (Blueprint $table) {
      $table->id();
      $table->foreignId('student_id')->constrained()->onDelete('cascade');
      $table->string('uuid');
      $table->string('title');
      $table->longText('description');
      $table->string('proof');
      $table->string('status')->default(Constant::PENDING);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('journals');
  }
};
