<?php

namespace App\Http\Controllers\Registrations;

use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Helpers\Global\Constant;
use App\Http\Controllers\Controller;
use App\Services\Registrations\StudentService;
use App\DataTables\Registrations\StudentDataTable;
use App\Http\Requests\Registrations\StudentRequest;

class StudentController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(
    protected StudentService $studentService
  ) {
    // 
  }

  /**
   * Display a listing of the resource.
   */
  public function index(StudentDataTable $studentDataTable)
  {
    return $studentDataTable->render('registrations.students.index');
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    if (isRoleName() != Constant::TEACHER) :
      abort('403');
    endif;

    // Get teacher data
    $teacher = $this->studentService->getTeacherByUserId(me()->id);
    return view('registrations.students.create', compact('teacher'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StudentRequest $request)
  {
    // Validasi id sekolah dan nama sekolah
    $teacher = $this->studentService->getTeacherByUserId(me()->id);

    if ($request->school_id != $teacher->school_id) :
      return back()->with('error', trans('Masukkan asal sekolah sesuai dengan asal sekolah anda'))->withInput();
    endif;

    if ($request->school_name != $teacher->school->name) :
      return back()->with('error', trans('Masukkan asal sekolah sesuai dengan asal sekolah anda'))->withInput();
    endif;

    $this->studentService->save($request);
    return redirect()->route('students.index')->withSuccess(trans('session.create'));
  }

  /**
   * Display the specified resource.
   */
  public function show(Student $student)
  {
    return view('registrations.students.show', compact('student'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Student $student)
  {
    $teacher = $this->checkUser($student);
    return view('registrations.students.edit', compact('teacher', 'student'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(StudentRequest $request, Student $student)
  {
    // Validasi id sekolah dan nama sekolah
    $teacher = $this->checkUser($student);

    if ($request->school_id != $teacher->school_id) :
      return back()->with('error', trans('Masukkan asal sekolah sesuai dengan asal sekolah anda'))->withInput();
    endif;

    if ($request->school_name != $teacher->school->name) :
      return back()->with('error', trans('Masukkan asal sekolah sesuai dengan asal sekolah anda'))->withInput();
    endif;

    $this->studentService->edit($student, $request);
    return redirect()->route('students.index')->withSuccess(trans('session.update'));
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Student $student)
  {
    $this->studentService->delete($student);
    return response()->json([
      'message' => trans('session.delete')
    ], 200);
  }

  /**
   * Check user before update data.
   */
  protected function checkUser($student)
  {
    if (isRoleName() == Constant::TEACHER) :
      $teacher = $this->studentService->getTeacherByUserId(me()->id);
    else :
      $teacher = Teacher::where('school_id', $student->school->id)->first();
    endif;

    return $teacher;
  }
}
