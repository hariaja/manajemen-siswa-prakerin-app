<?php

namespace App\Http\Controllers\Activities;

use App\Models\Holiday;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Master\StudyProgramService;
use App\DataTables\Activities\HolidayDataTable;
use App\Http\Requests\Activities\HolidayRequest;
use App\Services\Activities\HolidayService;

class HolidayController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(
    protected HolidayService $holidayService,
    protected StudyProgramService $prodiService,
  ) {
    // 
  }

  /**
   * Display a listing of the resource.
   */
  public function index(HolidayDataTable $holidayDataTable)
  {
    return $holidayDataTable->render('activities.holidays.index');
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $studyPrograms = $this->prodiService->all();
    return view('activities.holidays.create', compact('studyPrograms'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(HolidayRequest $request)
  {
    $this->holidayService->save($request);
    return redirect()->route('holidays.index')->withSuccess(trans('session.create'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Holiday $holiday)
  {
    $studyPrograms = $this->prodiService->all();
    return view('activities.holidays.edit', compact('holiday', 'studyPrograms'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(HolidayRequest $request, Holiday $holiday)
  {
    $this->holidayService->edit($holiday, $request);
    return redirect()->route('holidays.index')->withSuccess(trans('session.update'));
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Holiday $holiday)
  {
    $this->holidayService->delete($holiday);
    return response()->json([
      'message' => trans('session.delete'),
    ]);
  }
}
