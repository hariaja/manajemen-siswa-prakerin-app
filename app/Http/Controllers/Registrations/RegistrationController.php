<?php

namespace App\Http\Controllers\Registrations;

use App\DataTables\Registrations\RegistrationDataTable;
use App\DataTables\Scopes\StatusFilter;
use App\Helpers\Global\Constant;
use App\Http\Controllers\Controller;
use App\Http\Requests\Registrations\RegistrationRequest;
use App\Models\Registration;
use App\Services\Registrations\RegistrationService;
use App\Services\Registrations\StudentService;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(
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
    return view('registrations.registrations.create', compact('schedules'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {

    $request->validate([
      'date' => 'required|date',
      'schedule_id' => 'required',
      'name' => 'required|string',
      'email' => 'required|unique:users,email|email',
      'phone' => 'required|unique:users,phone|numeric',
      'birth_date' => 'required|date',
      'gender' => 'required|string',
      'class' => 'required|string',
      'note' => 'required|mimes:pdf|max:10240',
    ]);

    dd($request->all());

    $this->registrationService->save($request);
    return redirect()->route('registrations.index')->withSuccess(trans('session.create'));
  }

  /**
   * Display the specified resource.
   */
  public function show(Registration $registration)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Registration $registration)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Registration $registration)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Registration $registration)
  {
    //
  }
}
