<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
  use Uuid;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'user_id',
    'school_id',
    'uuid',
    'nisn',
    'major',
    'date_birth',
    'gender',
    'address',
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'date_birth' => 'date:c',
  ];

  /**
   * Get the route key for the model.
   */
  public function getRouteKeyName(): string
  {
    return 'uuid';
  }

  /**
   * Relationship to user model.
   */
  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class, 'user_id');
  }

  /**
   * Relationship to school models.
   */
  public function school(): BelongsTo
  {
    return $this->belongsTo(School::class, 'school_id');
  }

  /**
   * Relationship to Registration models.
   */
  public function registrations(): BelongsToMany
  {
    return $this->belongsToMany(
      Registration::class,
      'student_has_registrations',
      'student_id',
      'registration_id',
    );
  }

  /**
   * Relationship to presence models.
   */
  public function presences(): HasMany
  {
    return $this->hasMany(Presence::class, 'student_id');
  }

  /**
   * Relationship to excuse models.
   */
  public function excuses(): HasMany
  {
    return $this->hasMany(Excuse::class, 'student_id');
  }
}
