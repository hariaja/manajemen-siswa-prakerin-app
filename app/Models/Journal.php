<?php

namespace App\Models;

use App\Helpers\Global\Constant;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Journal extends Model
{
  use Uuid;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'student_id',
    'uuid',
    'title',
    'description',
    'proof',
    'status',
  ];

  /**
   * Get the route key for the model.
   */
  public function getRouteKeyName(): string
  {
    return 'uuid';
  }

  public function student(): BelongsTo
  {
    return $this->belongsTo(Student::class, 'student_id');
  }

  /**
   * Get the user status account.
   *
   */
  public function isStatus()
  {
    if ($this->status === Constant::PENDING) :
      return '<span class="badge text-primary">' . Constant::PENDING . '</span>';
    elseif ($this->status === Constant::APPROVED) :
      return '<span class="badge text-success">' . Constant::APPROVED . '</span>';
    else :
      return '<span class="badge text-danger">' . Constant::REJECTED . '</span>';
    endif;
  }
}
