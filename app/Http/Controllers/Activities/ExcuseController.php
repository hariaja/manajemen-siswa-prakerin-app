<?php

namespace App\Http\Controllers\Activities;

use App\DataTables\Activities\ExcuseDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Activities\ExcuseRequest;
use App\Models\Attendance;
use App\Models\Excuse;
use App\Services\Activities\ExcuseService;
use Illuminate\Http\Request;

class ExcuseController extends Controller
{
  public function __construct(protected ExcuseService $excuseService)
  {
    # code...
  }

  public function index(Attendance $attendance, ExcuseDataTable $excuseDataTable)
  {
    return $excuseDataTable->render('activities.excuses.index', compact('attendance'));
  }

  public function create(Attendance $attendance)
  {
    return view('students.excuses.create', compact('attendance'));
  }

  public function show(Excuse $excuse)
  {
    return response()->json($excuse);
  }

  public function store(ExcuseRequest $request, Attendance $attendance)
  {
    $this->excuseService->save($request, $attendance->id);
    return redirect()->route('students.presences.show', $attendance->uuid)->withSuccess('Permintaan izin sedang diproses. Silahkan tunggu...');
  }

  public function update(Request $request, Excuse $excus)
  {
    $this->excuseService->update($excus, $request);
    return redirect()->back()->withSuccess(trans('Berhasil memberikan izin'));
  }
}
