<?php

namespace App\Models;

use App\Traits\Uuid;
use App\Helpers\Global\Constant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class School extends Model
{
  use Uuid;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'uuid',
    'npsn',
    'name',
    'education',
    'status'
  ];

  protected $with = [
    'teachers',
    'students',
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
    if ($this->status == Constant::NEGERI) :
      return '<span class="badge text-primary">' . Constant::NEGERI . '</span>';
    else :
      return '<span class="badge text-secondary">' . Constant::SWASTA . '</span>';
    endif;
  }

  /**
   * Relationship to teacher model.
   */
  public function teachers(): HasMany
  {
    return $this->hasMany(Teacher::class, 'school_id');
  }

  /**
   * Relationship to student model.
   */
  public function students(): HasMany
  {
    return $this->hasMany(Student::class, 'school_id');
  }
}
