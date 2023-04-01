<?php

namespace App\Http\Controllers\Master;

use App\Models\Leader;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\Master\LeaderDataTable;
use App\Http\Requests\Master\LeaderRequest;
use App\Services\Master\LeaderService;
use App\Services\Master\StudyProgramService;

class LeaderController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(
    protected StudyProgramService $prodiService,
    protected LeaderService $leaderService,
  ) {
    // 
  }

  /**
   * Display a listing of the resource.
   */
  public function index(LeaderDataTable $dataTable)
  {
    return $dataTable->render('master.leaders.index');
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $studyPrograms = $this->prodiService->all();
    return view('master.leaders.create', compact('studyPrograms'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(LeaderRequest $request)
  {
    $this->leaderService->save($request);
    return redirect()->route('leaders.store')->withSuccess(trans('session.create'));
  }

  /**
   * Display the specified resource.
   */
  public function show(Leader $leader)
  {
    // dd($leader->user->hasVerifiedEmail());
    return view('master.leaders.show', compact('leader'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Leader $leader)
  {
    $studyPrograms = $this->prodiService->all();
    return view('master.leaders.edit', compact('studyPrograms', 'leader'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(LeaderRequest $request, Leader $leader)
  {
    $this->leaderService->edit($leader, $request);
    return redirect()->route('leaders.store')->withSuccess(trans('session.update'));
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Leader $leader)
  {
    $this->leaderService->delete($leader);
    return response()->json([
      'message' => trans('session.delete')
    ], 200);
  }
}
