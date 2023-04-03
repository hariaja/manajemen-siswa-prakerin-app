<?php

namespace App\Http\Controllers\Master;

use App\Models\Mentor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\Master\MentorDataTable;
use App\Http\Requests\Master\MentorRequest;
use App\Services\Master\MentorService;
use App\Services\Master\StudyProgramService;

class MentorController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(
    protected StudyProgramService $prodiService,
    protected MentorService $mentorService,
  ) {
    // 
  }

  /**
   * Display a listing of the resource.
   */
  public function index(MentorDataTable $mentorDataTable)
  {
    return $mentorDataTable->render('master.mentors.index');
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $studyPrograms = $this->prodiService->all();
    return view('master.mentors.create', compact('studyPrograms'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(MentorRequest $request)
  {
    $this->mentorService->save($request);
    return redirect()->route('mentors.index')->withSuccess(trans('session.create'));
  }

  /**
   * Display the specified resource.
   */
  public function show(Mentor $mentor)
  {
    return view('master.mentors.show', compact('mentor'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Mentor $mentor)
  {
    $studyPrograms = $this->prodiService->all();
    return view('master.mentors.edit', compact('studyPrograms', 'mentor'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(MentorRequest $request, Mentor $mentor)
  {
    $this->mentorService->edit($mentor, $request);
    return redirect()->route('mentors.index')->withSuccess(trans('session.update'));
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Mentor $mentor)
  {
    $this->mentorService->delete($mentor);
    return response()->json([
      'message' => trans('session.delete')
    ], 200);
  }
}
