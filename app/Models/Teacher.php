<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Teacher extends Model
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
    'gender',
    'address',
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
   * Relationship to school model.
   */
  public function school(): BelongsTo
  {
    return $this->belongsTo(School::class, 'school_id');
  }

  /**
   * Relationship to registration model.
   */
  public function registrations(): HasMany
  {
    return $this->hasMany(Registration::class, 'teacher_id');
  }
}
