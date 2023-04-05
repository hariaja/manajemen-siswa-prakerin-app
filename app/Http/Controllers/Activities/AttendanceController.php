<?php

namespace App\Http\Controllers\Activities;

use App\DataTables\Activities\AttendanceDataTable;
use App\Helpers\Global\Constant;
use App\Http\Controllers\Controller;
use App\Http\Requests\Activities\AttendanceRequest;
use App\Models\Attendance;
use App\Services\Activities\AttendanceService;
use Illuminate\Http\Request;

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
      return back()->with('error', 'Hanya kaprodi yang bisa menambahkan data kehadiran');
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

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Attendance $attendance)
  {
    $this->middleware(['role:' . Constant::LEADER]);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(AttendanceRequest $request, Attendance $attendance)
  {
    //
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
