<?php

namespace App\Http\Controllers\Educations;

use App\DataTables\Educations\SchoolDataTable;
use App\DataTables\Scopes\StatusFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Educations\SchoolRequest;
use App\Models\School;
use App\Services\Educations\SchoolService;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(protected SchoolService $service)
  {
    // 
  }

  /**
   * Display a listing of the resource.
   */
  public function index(SchoolDataTable $schoolDataTable, Request $request)
  {
    return $schoolDataTable->addScope(new StatusFilter($request))->render('educations.schools.index');
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('educations.schools.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(SchoolRequest $request)
  {
    $this->service->save($request);
    return redirect()->route('schools.index')->withSuccess(trans('session.create'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(School $school)
  {
    return view('educations.schools.edit', compact('school'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(SchoolRequest $request, School $school)
  {
    $this->service->edit($school, $request);
    return redirect()->route('schools.index')->withSuccess(trans('session.create'));
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(School $school)
  {
    $this->service->delete($school);
    return response()->json([
      'message' => trans('session.delete')
    ], 200);
  }
}
