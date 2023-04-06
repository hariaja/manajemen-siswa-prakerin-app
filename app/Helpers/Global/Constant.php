<?php

namespace App\Helpers\Global;

class Constant
{
  // Role Name
  public const ADMIN = 'Administrator';
  public const LEADER = 'Leader';
  public const MENTOR = 'Mentor';
  public const TEACHER = 'Teacher';
  public const STUDENT = 'Student';

  // Gender Name
  public const MALE = 'Laki - Laki';
  public const FEMALE = 'Perempuan';

  // User Status
  public const ACTIVE = 1;
  public const INACTIVE = 0;

  // Submit Registration
  public const OPEN = 1;
  public const CLOSE = 0;

  // Registration Status
  public const PENDING = 'Pending';
  public const APPROVED = 'Approved';
  public const REJECTED = 'Rejected';
  public const ALL = 'Semua Status';
  public const ROLES = 'Semua Peran';

  // Method
  public const GET = 'GET';
  public const POST = 'POST';
  public const PATCH = 'PATCH';
  public const PUT = 'PUT';
  public const DELETE = 'DELETE';

  // State Verified
  public const VERIFIED = 'Sudah Verifikasi Email';
  public const UNVERIFIED = 'Belum Verifikasi Email';

  // School Status
  public const NEGERI = 'Negeri';
  public const SWASTA = 'Swasta';
  public const SMK = 'SMK';
  public const SMA = 'SMA';
  public const STM = 'STM';

  // Permissions
  public const IZIN = 1;
  public const TIDAK_IZIN = 0;
}
