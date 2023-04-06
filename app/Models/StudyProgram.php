<?php

namespace App\Models;

use App\Traits\Uuid;
use App\Helpers\Global\Constant;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;

class StudyProgram extends Model
{
  use Uuid;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'uuid',
    'name',
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
   * Get the user status account.
   *
   */
  public function isStatus()
  {
    if ($this->status == Constant::ACTIVE) :
      return '<span class="badge text-success">Active</span>';
    else :
      return '<span class="badge text-danger">Inactive</span>';
    endif;
  }

  /**
   * Scope a query to only include active prodi.
   */
  public function scopeActive($data)
  {
    return $data->where('status', Constant::ACTIVE);
  }

  public function getActive(): Collection
  {
    return $this->active()->get();
  }

  /**
   * Relationship to leader model.
   */
  public function leaders(): HasMany
  {
    return $this->hasMany(Leader::class, 'study_program_id');
  }

  /**
   * Relationship to mentor model.
   */
  public function mentors(): HasMany
  {
    return $this->hasMany(Mentor::class, 'study_program_id');
  }

  /**
   * Relationship to Registration models.
   */
  public function registrations(): HasMany
  {
    return $this->hasMany(Registration::class, 'study_program_id');
  }

  /**
   * Relationship to holiday model.
   */
  public function holiday(): HasMany
  {
    return $this->hasMany(Holiday::class, 'study_program_id');
  }

  public function registrationData()
  {
    // registration status
    $registrations = $this->registrations;

    // dd($registrations);

    foreach ($registrations as $items) {
      foreach ($items->students as $item) {
        $status_prakerin = $item->pivot->status;
        $start_date = Carbon::parse($item->pivot->duration_start_date);
        $end_date = Carbon::parse($item->pivot->duration_end_date);
        $duration = $end_date->diffInDays($start_date);
      }

      $total_student = $items->students->count();
    }

    if ($registrations->isNotEmpty()) {
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
}
