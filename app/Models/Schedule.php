<?php

namespace App\Models;

use App\Traits\Uuid;
use App\Helpers\Global\Constant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Schedule extends Model
{
  use Uuid;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'uuid',
    'title',
    'start',
    'end',
    'status'
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'start' => 'date:c',
    'end' => 'date:c'
  ];

  /**
   * Get the route key for the model.
   */
  public function getRouteKeyName(): string
  {
    return 'uuid';
  }

  /**
   * Schedule status convert from database.
   */
  public function isStatus()
  {
    if ($this->status == Constant::OPEN) :
      return '<span class="badge text-success">Pendaftaran Dibuka</span>';
    else :
      return '<span class="badge text-warning">Pendaftaran Ditutup</span>';
    endif;
  }

  /**
   * Scope a query to only include open schedule.
   */
  public function scopeOpen($data)
  {
    return $data->where('status', Constant::OPEN);
  }

  public function getOpen(): Collection
  {
    return $this->open()->get();
  }
}
