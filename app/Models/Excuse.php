<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Excuse extends Model
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
    'title',
    'description',
    'excuse_date',
    'is_accepted',
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
