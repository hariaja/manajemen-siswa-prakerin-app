<?php

namespace App\Http\Controllers\Master;

use App\DataTables\Master\StudyProgramDataTable;
use App\DataTables\Scopes\StatusFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Master\StudyProgramRequest;
use App\Models\StudyProgram;
use App\Services\Master\StudyProgramService;
use Illuminate\Http\Request;

class StudyProgramController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(protected StudyProgramService $service)
  {
    // 
  }

  /**
   * Display a listing of the resource.
   */
  public function index(StudyProgramDataTable $dataTable, Request $request)
  {
    return $dataTable->addScope(new StatusFilter($request))->render('master.study-programs.index');
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('master.study-programs.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StudyProgramRequest $request)
  {
    $this->service->save($request);
    return redirect()->route('study-programs.index')->with('success', trans('session.create'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(StudyProgram $studyProgram)
  {
    return view('master.study-programs.edit', compact('studyProgram'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(StudyProgramRequest $request, StudyProgram $studyProgram)
  {
    $this->service->edit($studyProgram, $request);
    return redirect()->route('study-programs.index')->with('success', trans('session.update'));
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(StudyProgram $studyProgram)
  {
    $this->service->delete($studyProgram);
    return response()->json([
      'message' => trans('session.delete')
    ], 200);
  }
}
