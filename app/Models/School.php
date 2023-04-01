<?php

namespace App\Models;

use App\Traits\Uuid;
use App\Helpers\Global\Constant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
}
