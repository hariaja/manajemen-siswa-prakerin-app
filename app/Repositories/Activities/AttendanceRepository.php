<?php

namespace App\Repositories\Activities;

use App\Models\Attendance;
use Illuminate\Database\Eloquent\Model;

class AttendanceRepository
{
  public function __construct(protected Attendance $attendance)
  {
    # code...
  }
}
