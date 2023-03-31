<?php

namespace App\Http\Controllers\Registrations;

use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\Scopes\StatusFilter;
use App\DataTables\Registrations\ScheduleDataTable;
use App\Http\Requests\Registrations\ScheduleRequest;
use App\Services\Registrations\ScheduleService;

class ScheduleController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(protected ScheduleService $service)
  {
    // 
  }

  /**
   * Display a listing of the resource.
   */
  public function index(ScheduleDataTable $dataTable, Request $request)
  {
    return $dataTable->addScope(new StatusFilter($request))->render('registrations.schedules.index');
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('registrations.schedules.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(ScheduleRequest $request)
  {
    $this->service->save($request);
    return redirect()->route('schedules.index')->with('success', trans('session.create'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Schedule $schedule)
  {
    return view('registrations.schedules.edit', compact('schedule'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(ScheduleRequest $request, Schedule $schedule)
  {
    $this->service->edit($schedule, $request);
    return redirect()->route('schedules.index')->with('success', trans('session.create'));
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Schedule $schedule)
  {
    $this->service->delete($schedule);
    return response()->json([
      'message' => trans('session.delete')
    ], 200);
  }
}
