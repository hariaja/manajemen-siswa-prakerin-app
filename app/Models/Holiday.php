<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Holiday extends Model
{
  use Uuid;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'uuid',
    'study_program_id',
    'title',
    'holiday_date',
    'description',
  ];

  /**
   * Relationship to study program model.
   */
  public function studyProgram(): BelongsTo
  {
    return $this->belongsTo(StudyProgram::class, 'study_program_id');
  }
}
