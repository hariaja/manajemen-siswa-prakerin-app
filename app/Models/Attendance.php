<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attendance extends Model
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
    'start_time',
    'timeout_start_time',
    'end_time',
    'timeout_end_time',
    'description',
  ];

  /**
   * Get the route key for the model.
   */
  public function getRouteKeyName(): string
  {
    return 'uuid';
  }

  /**
   * Relationship to study program model.
   */
  public function studyProgram(): BelongsTo
  {
    return $this->belongsTo(StudyProgram::class, 'study_program_id');
  }

  /**
   * Relationship to presence models.
   */
  public function presences(): HasMany
  {
    return $this->hasMany(Presence::class, 'attedance_id');
  }

  /**
   * Relationship to excuse models.
   */
  public function excuses(): HasMany
  {
    return $this->hasMany(Excuse::class, 'attedance_id');
  }
}
