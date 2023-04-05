<?php

namespace App\Repositories\Activities;

use App\Models\Excuse;

class ExcuseRepository
{
  public function __construct(protected Excuse $excuse)
  {
    # code...
  }

  public function isTherePermission($attendance_id)
  {
    return $this->excuse->query()
      ->where('excuse_date', now()->toDateString())
      ->where('attendance_id', $attendance_id)
      ->where('student_id', isStudent()->id)
      ->first();
  }
}
