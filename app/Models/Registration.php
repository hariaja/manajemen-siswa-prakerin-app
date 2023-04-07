<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Support\Carbon;
use App\Helpers\Global\Constant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Registration extends Model
{
  use Uuid;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'teacher_id',
    'schedule_id',
    'study_program_id',
    'uuid',
    'code',
    'note',
    'register_date',
    'status',
  ];

  /**
   * Get the route key for the model.
   */
  public function getRouteKeyName(): string
  {
    return 'uuid';
  }

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'register_date' => 'date:c',
  ];

  /**
   * Relationship to teacher model.
   */
  public function teacher(): BelongsTo
  {
    return $this->belongsTo(Teacher::class, 'teacher_id');
  }

  /**
   * Relationship to schedule model.
   */
  public function schedule(): BelongsTo
  {
    return $this->belongsTo(Schedule::class, 'schedule_id');
  }

  /**
   * Relationship to student models.
   */
  public function students(): BelongsToMany
  {
    return $this->belongsToMany(
      Student::class,
      'student_has_registrations',
      'registration_id',
      'student_id',
    )->withPivot(
      'status',
      'duration_end_date',
      'duration_start_date',
    );
  }

  /**
   * Relationship to study program model.
   */
  public function studyProgram(): BelongsTo
  {
    return $this->belongsTo(StudyProgram::class, 'study_program_id');
  }

  public function getDiffDuration()
  {
    if ($this->students) :
      foreach ($this->students as $item) :
        $start_date = Carbon::parse($item->pivot->duration_start_date);
        $end_date = Carbon::parse($item->pivot->duration_end_date);
        $end_final = $end_date->diffInDays($start_date);
        return $end_final . ' Hari';
      endforeach;
    else :
      return 'Data Siswa Belum Terdaftar';
    endif;
  }

  public function datas()
  {
    foreach ($this->students as $item) {
      $status_prakerin = $item->pivot->status;
      $start_date = Carbon::parse($item->pivot->duration_start_date);
      $end_date = Carbon::parse($item->pivot->duration_end_date);
      $duration = $end_date->diffInDays($start_date);
    }

    $total_student = $this->students->count();

    if ($this->students->isNotEmpty()) {
      $data = [
        'status_prakerin' => $status_prakerin,
        'duration_prakerin' => $duration . ' Hari',
        'total_student' => $total_student . ' Siswa',
      ];
    } else {
      $data = [
        'status_prakerin' => 0,
        'duration_prakerin' => '-',
        'total_student' => '-',
      ];
    }

    return (object) $data;
  }

  /**
   * Scope a query to only include pending registration.
   */
  public function scopePending($data)
  {
    return $data->where('status', Constant::PENDING);
  }

  public function getPending(): Collection
  {
    return $this->pending()->get();
  }

  /**
   * Scope a query to only include approved registration.
   */
  public function scopeApproved($data)
  {
    return $data->where('status', Constant::APPROVED);
  }

  public function getApproved(): Collection
  {
    return $this->approved()->get();
  }

  /**
   * Scope a query to only include rejected registration.
   */
  public function scopeRejected($data)
  {
    return $data->where('status', Constant::REJECTED);
  }

  public function getRejected(): Collection
  {
    return $this->rejected()->get();
  }
}
