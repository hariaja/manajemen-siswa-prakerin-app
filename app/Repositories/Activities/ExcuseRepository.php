<?php

namespace App\Repositories\Activities;

use App\Models\Excuse;
use App\Models\Presence;
use Illuminate\Database\Eloquent\Model;

class ExcuseRepository
{
  public function __construct(protected Excuse $excuse)
  {
    # code...
  }

  public function getByDate($attendance_id)
  {
    return $this->excuse->query()
      ->where('attendance_id', $attendance_id)
      ->where('excuse_date', now()->toDateString());
  }

  public function isTherePermission($attendance_id)
  {
    return $this->excuse->query()
      ->where('excuse_date', now()->toDateString())
      ->where('attendance_id', $attendance_id)
      ->where('student_id', isStudent()->id)
      ->first();
  }

  public function save($request, $attendance_id)
  {
    $save = $this->excuse->firstOrCreate([
      'student_id' => isStudent()->id,
      'attendance_id' => $attendance_id,
      'title' => $request->title,
      'description' => $request->description,
      'excuse_date' => now()->toDateString(),
    ]);

    return $save;
  }

  public function getById($excuse_id): Model
  {
    return $this->excuse->findOrFail($excuse_id);
  }

  public function update($excuse_id, $request)
  {
    $excuse = $this->getById($excuse_id);

    Presence::firstOrCreate([
      'student_id' => $excuse->student_id,
      'attendance_id' => $excuse->attendance_id,
      'presence_date' => $request->excuse_date,
      'presence_enter_time' => now()->toTimeString(),
      'presence_out_time' => now()->toTimeString(),
      'is_permission' => true
    ]);

    $excuse->updateOrFail([
      'is_accepted' => true
    ]);

    return $excuse;
  }
}
