<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Presence extends Model
{
  use Uuid;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'student_id',
    'attendance_id',
    'uuid',
    'presence_date',
    'presence_enter_time',
    'presence_out_time',
    'is_permission',
  ];

  /**
   * Get the route key for the model.
   */
  public function getRouteKeyName(): string
  {
    return 'uuid';
  }

  /**
   * Relationship to student model.
   */
  public function student(): BelongsTo
  {
    return $this->belongsTo(Student::class, 'student_id');
  }

  /**
   * Relationship to attendance model.
   */
  public function attendance(): BelongsTo
  {
    return $this->belongsTo(Attendance::class, 'attendance_id');
  }
}
