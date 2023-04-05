<?php

namespace App\Repositories\Activities;

use App\Models\Presence;

class PresenceRepository
{
  public function __construct(protected Presence $presence)
  {
    # code...
  }

  public function getByStudent($attendance_id)
  {
    return $this->presence->query()
      ->where('attendance_id', $attendance_id)
      ->where('student_id', isStudent()->id)
      ->get();
  }

  public function isHasEnterToday($attendance_id)
  {
    $presence = $this->getByStudent($attendance_id);
    return $presence->where('presence_date', now()->toDateString())->isNotEmpty();
  }

  public function isNotOutYet($attendance_id)
  {
    $presence = $this->getByStudent($attendance_id);
    return $presence->where('presence_out_time', null)->isNotEmpty();
  }
}
