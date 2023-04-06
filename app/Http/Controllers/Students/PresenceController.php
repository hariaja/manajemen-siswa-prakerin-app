<?php

namespace App\Http\Controllers\Students;

use App\Models\Presence;
use Carbon\CarbonPeriod;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Activities\ExcuseService;
use App\Services\Activities\HolidayService;
use App\Services\Activities\PresenceService;
use App\Services\Activities\AttendanceService;

class PresenceController extends Controller
{
  public $datas;

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
    $attendances = $this->attendanceService->getByStudyProdiIds(getStudentStudyProgram()->id);
    return view('students.presences.index', compact('attendances'));
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
  public function store(Request $request, Attendance $attendance)
  {
    if ($attendance->data->is_start) :
      // Add presence to database
      $this->presenceService->save($attendance->id);

      // Change state of $datas
      $this->datas['is_has_enter_today'] = true;
      $this->datas['is_not_out_yet'] = true;

      return redirect()->route('students.presences.show', $attendance->uuid)->withSuccess('Kehadiran atas nama ' . isStudent()->user->name . ' berhasil di kirim');
    endif;

    return back()->with('error', 'Gagal melakukan absensi');
  }

  /**
   * Display the specified resource.
   */
  public function show(Attendance $attendance)
  {
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
  public function update(Attendance $attendance)
  {
    if (!$attendance->data->is_end) :
      return false;
    endif;

    $presence = $this->presenceService->getByNow($attendance->id);

    // untuk refresh if statement
    $this->datas['is_not_out_yet'] = false;
    $presence->update(['presence_out_time' => now()->toTimeString()]);

    return redirect()->route('students.presences.show', $attendance->uuid)->withSuccess('Kehadiran atas nama ' . isStudent()->user->name . ' berhasil melakukan checkout');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Presence $presence)
  {
    //
  }
}
