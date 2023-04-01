<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Helpers\Global\Constant;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
  use HasApiTokens, HasFactory, Notifiable, HasRoles;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'name',
    'email',
    'phone',
    'password',
    'avatar',
    'status'
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  /**
   * Return default avatar user.
   */
  public function getAvatar()
  {
    if (!$this->avatar) :
      return asset('assets/images/default.png');
    else :
      return Storage::url($this->avatar);
    endif;
  }

  /**
   * Get the user role name.
   *
   */
  public function isRoleName()
  {
    return $this->roles->implode('name');
  }

  /**
   * Get the user role id.
   *
   */
  public function isRoleId()
  {
    return $this->roles->implode('id');
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
   * Get the user status verified email account.
   *
   */
  public function isVerified()
  {
    if ($this->hasVerifiedEmail()) :
      return '<span class="badge text-success">' . Constant::VERIFIED . '</span>';
    else :
      return '<span class="badge text-danger">' . Constant::UNVERIFIED . '</span>';
    endif;
  }

  /**
   * Relationship to leader model.
   */
  public function leader(): HasMany
  {
    return $this->hasMany(Leader::class, 'user_id');
  }

  /**
   * Relationship to mentor model.
   */
  public function mentor(): HasMany
  {
    return $this->hasMany(Mentor::class, 'user_id');
  }
}
