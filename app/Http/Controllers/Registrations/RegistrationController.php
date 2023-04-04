<?php

namespace App\Http\Controllers\Registrations;

use App\Models\Teacher;
use App\Models\Registration;
use Illuminate\Http\Request;
use App\Helpers\Global\Constant;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\DataTables\Scopes\StatusFilter;
use App\Services\Master\StudyProgramService;
use App\Services\Registrations\StudentService;
use App\Services\Registrations\RegistrationService;
use App\DataTables\Registrations\RegistrationDataTable;
use App\Http\Requests\Registrations\RegistrationRequest;

class RegistrationController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(
    protected StudyProgramService $prodiService,
    protected RegistrationService $registrationService,
    protected StudentService $studentService,
  ) {
    // 
  }

  /**
   * Display a listing of the resource.
   */
  public function index(RegistrationDataTable $registrationDataTable, Request $request)
  {
    return $registrationDataTable
      ->addScope(new StatusFilter($request))
      ->render('registrations.registrations.index');
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    if (isRoleName() != Constant::TEACHER) :
      abort('403');
    endif;

    $check = $this->studentService->check();

    if ($check->isEmpty()) :
      return redirect()->back()->with('error', trans('Anda belum menambahkan data siswa, mohon tambahkan terlebih dahulu di menu siswa'));
    endif;

    $schedules = $this->registrationService->scheduleOpen();
    $teacher = $this->studentService->getTeacherByUserId(me()->id);
    $students = $this->studentService->checkIfStudentRegistered();

    return view('registrations.registrations.create', compact('schedules', 'teacher', 'students'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(RegistrationRequest $request)
  {
    // Validasi id sekolah dan nama sekolah
    $teacher = $this->studentService->getTeacherByUserId(me()->id);

    if ($request->teacher_id != $teacher->id) :
      return back()->with('error', trans('Data tidak valid'))->withInput();
    endif;

    $this->registrationService->save($request);
    return redirect()->route('registrations.index')->withSuccess(trans('session.create'));
  }

  /**
   * Display the specified resource.
   */
  public function show(Registration $registration, Request $request)
  {

    if ($request->ajax()) :
      return $this->registrationService->details($registration);
    endif;

    $teacher = $registration->teacher;
    $studyPrograms = $this->prodiService->all();
    return view('registrations.registrations.show', compact('registration', 'teacher', 'studyPrograms'));
  }

  public function update(Request $request, Registration $registration)
  {
    $this->registrationService->editStatus($registration, $request);
    return redirect()->route('registrations.show', $registration->uuid)->withSuccess(trans('session.create'));
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Registration $registration)
  {
    //
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
