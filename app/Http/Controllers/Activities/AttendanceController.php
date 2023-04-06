<?php

namespace App\Http\Controllers\Activities;

use App\Models\Attendance;
use App\Models\StudyProgram;
use Illuminate\Http\Request;
use App\Helpers\Global\Constant;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use App\Services\Activities\AttendanceService;
use App\DataTables\Activities\AttendanceDataTable;
use App\Http\Requests\Activities\AttendanceRequest;

class AttendanceController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(
    protected AttendanceService $attendanceService,
  ) {
    // 
  }

  /**
   * Display a listing of the resource.
   */
  public function index(AttendanceDataTable $attendanceDataTable)
  {
    return $attendanceDataTable->render('activities.attendances.index');
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    if ($this->attendanceService->count() > 0) :
      return back()->with('error', 'Data kehadiran sudah tersedia. Anda hanya bisa menambahkan 1 data kehadiran saja di masing-masing program studi');
    endif;

    if (isRoleName() !== Constant::LEADER) :
      abort('403', 'Anda tidak memiliki akses untuk melakukan penambahan data');
    endif;

    return view('activities.attendances.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(AttendanceRequest $request)
  {
    if ($request->study_program_id != isLeader()->studyProgram->id) :
      return back()->with('error', 'Program study is invalid.');
    endif;

    $this->attendanceService->save($request);
    return redirect()->route('attendances.index')->withSuccess(trans('session.create'));
  }

  public function show(Attendance $attendance, Request $request)
  {
    // dd($attendance->studyProgram->registrationData());
    if ($request->ajax()) {
      return $this->attendanceService->getAttendancePresence($attendance->id);
    }
    return view('activities.attendances.show', compact('attendance'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Attendance $attendance)
  {
    if (isRoleName() !== Constant::LEADER) :
      abort('403', 'Anda tidak memiliki akses untuk melakukan perubahan');
    endif;

    return view('activities.attendances.edit', compact('attendance'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(AttendanceRequest $request, Attendance $attendance)
  {
    if ($request->study_program_id != isLeader()->studyProgram->id) :
      return back()->with('error', 'Program study is invalid.');
    endif;

    $this->attendanceService->edit($attendance, $request);
    return redirect()->route('attendances.index')->withSuccess(trans('session.update'));
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Attendance $attendance)
  {
    $this->attendanceService->delete($attendance);
    return response()->json([
      'message' => trans('session.delete')
    ]);
  }
}
