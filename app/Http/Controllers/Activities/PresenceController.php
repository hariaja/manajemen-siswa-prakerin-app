<?php

namespace App\Http\Controllers\Activities;

use App\Models\Presence;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Helpers\Global\Constant;
use App\Http\Controllers\Controller;
use App\Services\Activities\HolidayService;
use App\Services\Activities\PresenceService;
use App\Services\Activities\AttendanceService;
use App\Services\Activities\ExcuseService;
use Carbon\CarbonPeriod;

class PresenceController extends Controller
{
  public function __construct(
    protected ExcuseService $excuseService,
    protected HolidayService $holidayService,
    protected PresenceService $presenceService,
    protected AttendanceService $attendanceService,
  ) {
    # code...
  }

  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    if (isRoleName() === Constant::STUDENT) :
      $attendances = $this->attendanceService->getByStudyProdiIds(getStudentStudyProgram()->id);
      return view('students.presences.index', compact('attendances'));
    endif;
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   */
  public function show(Attendance $attendance)
  {
    if (isRoleName() === Constant::STUDENT) :
      $isHasEnterToday = $this->presenceService->isHasEnterToday($attendance->id);
      $isTherePermission = $this->excuseService->isTherePermission($attendance->id);
      $isNotOutYet = $this->presenceService->isNotOutYet($attendance->id);

      $datas = [
        'is_has_enter_today' => $isHasEnterToday, // sudah absen masuk
        'is_not_out_yet' => $isNotOutYet, // belum absen pulang
        'is_there_permission' => (bool) $isTherePermission,
        'is_permission_accepted' => $isTherePermission->izin_diterima ?? false
      ];

      $holiday = $attendance->data->is_holiday_today ? $this->holidayService->isHolidayToday() : false;
      $history = $this->presenceService->getByStudent($attendance->id);

      $periodDate = CarbonPeriod::create($attendance->created_at->toDateString(), now()->toDateString())->toArray();

      foreach ($periodDate as $i => $date) { // get only stringdate
        $periodDate[$i] = $date->toDateString();
      }

      $periodDate = array_slice(array_reverse($periodDate), 0, 30);
      return view('students.presences.show', compact(
        'attendance',
        'datas',
        'holiday',
        'history',
        'periodDate'
      ));
    endif;
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Presence $presence)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Presence $presence)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Presence $presence)
  {
    //
  }
}
