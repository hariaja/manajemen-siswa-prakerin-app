<?php

namespace App\Repositories\Activities;

use App\Models\Attendance;
use Illuminate\Support\Str;
use App\Helpers\Global\Constant;
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

  public function getById($id)
  {
    return $this->attendance->query()->where('id', $id)->first();
  }

  public function getAttendancePresence($id)
  {
    $attendance = $this->getById($id);
    return datatables()->of($attendance->presences)
      ->addIndexColumn()
      ->addColumn('student_name', function ($row) {
        return $row->student->user->name;
      })
      ->editColumn('presence_date', function ($row) {
        return customDate($row->presence_date);
      })
      ->editColumn('is_permission', function ($row) {
        if ($row->is_permission == Constant::IZIN) {
          return '<span class="badge rounded text-white bg-warning">Izin</span>';
        } else {
          return '<span class="badge rounded text-bg-success">Hadir</span>';
        }
      })
      ->editColumn('presence_enter_time', function ($row) {
        return Str::substr($row->presence_enter_time, 0, -3);
      })
      ->editColumn('presence_out_time', function ($row) {
        if ($row->presence_out_time) {
          return Str::substr($row->presence_out_time, 0, -3);
        } else {
          return 'Belum absen pulang';
        }
      })
      ->rawColumns(['is_permission'])
      ->make(true);
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
