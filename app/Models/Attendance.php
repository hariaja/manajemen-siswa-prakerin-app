<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
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

  protected $appends = ['data'];

  protected function data(): Attribute
  {
    return Attribute::get(function ($value) {
      $now = now();
      $startTime = Carbon::parse($this->start_time);
      $timeoutStartTime = Carbon::parse($this->timeout_start_time);

      $endTime = Carbon::parse($this->end_time);
      $timeoutEndTime = Carbon::parse($this->timeout_end_time);

      $isHolidayToday = Holiday::query()
        ->where('holiday_date', now()->toDateString())
        ->get();

      return (object) [
        'start_time' => $this->start_time,
        'timeout_start_time' => $this->timeout_start_time,
        'end_time' => $this->end_time,
        'timeout_end_time' => $this->timeout_end_time,
        'now' => $now->format('H:i:s'),
        'is_start' => $startTime <= $now && $timeoutStartTime >= $now,
        'is_end' => $endTime <= $now && $timeoutEndTime >= $now,
        'is_holiday_today' => $isHolidayToday->isNotEmpty(),
      ];
    });
  }

  public function isAttendanceStatus()
  {
    if ($this->data->is_holiday_today) :
      return '<span class="badge text-danger">Hari Libur</span>';
    elseif ($this->data->is_start) :
      return '<span class="badge text-success">Jam Masuk</span>';
    elseif ($this->data->is_end) :
      return '<span class="badge text-warning">Jam Masuk</span>';
    else :
      return '<span class="badge text-secondary">Absensi Ditutup</span>';
    endif;
  }
}
