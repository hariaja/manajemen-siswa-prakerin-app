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

  public function getAll()
  {
    return $this->attendance->all()->sortByDesc('data.is_end')->sortByDesc('data.start');
  }

  public function getByStudyProdiId($study_program_id)
  {
    return $this->attendance->all()->where('study_program_id', $study_program_id)->sortByDesc('data.is_end')->sortByDesc('data.is_start');
  }

  public function count()
  {
    $studyProgramId = isLeader()->study_program_id;
    return $this->attendance->whereHas('studyProgram', function ($query) use ($studyProgramId) {
      $query->where('id', '=', $studyProgramId);
    })->count();
  }

  public function save($request)
  {
    $this->attendance->firstOrCreate([
      'study_program_id' => $request->study_program_id,
      'title' => $request->title,
      'start_time' => $request->start_time,
      'timeout_start_time' => $request->timeout_start_time,
      'end_time' => $request->end_time,
      'timeout_end_time' => $request->timeout_end_time,
      'description' => $request->description,
    ]);
  }

  public function edit($id, $request)
  {
    $attendance = $this->getDataById($id);
    $attendance->updateOrFail([
      'study_program_id' => $request->study_program_id,
      'title' => $request->title,
      'start_time' => $request->start_time,
      'timeout_start_time' => $request->timeout_start_time,
      'end_time' => $request->end_time,
      'timeout_end_time' => $request->timeout_end_time,
      'description' => $request->description,
    ]);
  }

  public function getDataById($id): Model
  {
    return $this->attendance->findOrFail($id);
  }

  public function delete($id)
  {
    $attendance = $this->getDataById($id);
    return $attendance->delete();
  }
}
