<?php

namespace App\Http\Controllers\Educations;

use App\DataTables\Educations\TeacherDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Educations\TeacherRequest;
use App\Models\Teacher;
use App\Services\Educations\TeacherService;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(protected TeacherService $service)
  {
    # code...
  }

  /**
   * Display a listing of the resource.
   */
  public function index(TeacherDataTable $teacherDataTable)
  {
    return $teacherDataTable->render('educations.teachers.index');
  }

  /**
   * Display the specified resource.
   */
  public function show(Teacher $teacher)
  {
    return view('educations.teachers.show', compact('teacher'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Teacher $teacher)
  {
    $schools = $this->service->getSchools()->get();
    return view('educations.teachers.edit', compact('teacher', 'schools'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(TeacherRequest $request, Teacher $teacher)
  {
    $this->service->edit($teacher, $request);
    return redirect()->route('teachers.index')->withSuccess(trans('session.update'));
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Teacher $teacher)
  {
    $this->service->delete($teacher);
    return response()->json([
      'message' => trans('session.delete')
    ], 200);
  }
}
