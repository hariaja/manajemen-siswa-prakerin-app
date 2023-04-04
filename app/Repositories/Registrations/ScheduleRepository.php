<?php

namespace App\Repositories\Registrations;

use App\Models\Schedule;
use Illuminate\Database\Eloquent\Model;

class ScheduleRepository
{
  public function __construct(protected Schedule $schedule)
  {
    # code...
  }

  public function scheduleOpen()
  {
    return $this->schedule
      ->open()
      ->orderBy('title')
      ->get();
  }

  public function save($request)
  {
    return $this->schedule->firstOrCreate([
      'title' => $request->title,
      'start' => $request->start,
      'end' => $request->end,
    ]);
  }

  public function getDataById($id): Model
  {
    return $this->schedule->findOrFail($id);
  }

  public function edit($id, $request)
  {
    $schedule = $this->getDataById($id);
    return $schedule->updateOrFail([
      'title' => $request->title,
      'start' => $request->start,
      'end' => $request->end,
      'status' => $request->status,
    ]);
  }

  public function delete($id)
  {
    $schedule = $this->getDataById($id);
    return $schedule->deleteOrFail();
  }
}
